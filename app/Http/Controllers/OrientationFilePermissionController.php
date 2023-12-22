<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OrientationFilePermission;

class OrientationFilePermissionController extends Controller
{
    function index()
    {
        return OrientationFilePermission::all();
    }

    function show($id)
    {
        return OrientationFilePermission::findOrFail($id);
    }

    function get_all_by_orientation_file_id($id)
    {
        // mappe noch die Daten aus den anderen Tabellen
        return OrientationFilePermission::where('orientation_file_id', $id)->get();
    }

    function get_all_by_user_id($id)
    {
        return OrientationFilePermission::where('user_id', $id)->get();
    }

    function store(Request $request)
    {
        // Überprüfe ob es eine company_id oder user_id gibt
        if ($request->company_id == null && $request->user_id == null) {
            return response()->json(['message' => 'No company_id or user_id given'], 400);
        }

        $user = $request->user();
        $orientationFilepermission = new OrientationFilePermission();
        $orientationFilepermission->orientation_file_id = $request->orientation_file_id;
        $orientationFilepermission->user_id = $request->user_id ?? null;
        $orientationFilepermission->company_id = $request->company_id ?? null;
        $orientationFilepermission->granted_by = $user->id;
        $orientationFilepermission->save();
        return $orientationFilepermission;
    }

    function update(Request $request, $id)
    {
        $orientationFilepermission = OrientationFilePermission::findOrFail($id);
        if ($request->orientation_file_id) {
            $orientationFilepermission->orientation_file_id = $request->orientation_file_id;
        }
        if ($request->user_id) {
            $orientationFilepermission->user_id = $request->user_id;
        }
        if ($request->granted_by) {
            $orientationFilepermission->granted_by = $request->granted_by;
        }
        $orientationFilepermission->save();
        return $orientationFilepermission;
    }

    function destroy($id)
    {
        $orientationFilepermission = OrientationFilePermission::findOrFail($id);
        $orientationFilepermission->delete();
        return response()->json(['message' => 'OrientationFilePermission deleted'], 200);
    }


}
