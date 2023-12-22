<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrientationFile;
use App\Models\OrientationFilePermission;

use App\Http\Resources\OrientationFileResource;

class OrientationFileController extends Controller
{
    function index()
    {
        return OrientationFileResource::collection(OrientationFile::all());
    }

    function id(Request $request, int $id)
    {
        $user = $request->user();
        //Überprüfen ob der User die Berechtigung hat die Datei zu sehen
        $orientation_file = OrientationFile::findOrFail($id);
        $orientation_file_permissions = OrientationFilePermission::where('user_id', $user->id)->get();
        foreach ($orientation_file_permissions as $orientation_file_permission) {
            if ($orientation_file->id == $orientation_file_permission->orientation_file_id) {
                return new OrientationFileResource($orientation_file);
            }
        }
        if ($orientation_file->company_id != null) {
            if ($orientation_file->company_id == $user->company_id) {
                if ($orientation_file->rank != null) {
                    if ($orientation_file->rank->level <= $user->rank->level) {
                        return new OrientationFileResource($orientation_file);
                    }
                }
                else {
                    return new OrientationFileResource($orientation_file);
                }
            }
        }
        else {
            if ($orientation_file->rank->level <= $user->rank->level) {
                return new OrientationFileResource($orientation_file);
            }
        }
        return response()->json(['message' => 'No files found'], 404);
    }

    function store(Request $request)
    {

        $user = $request->user();
        $user_identification = $user->identification;

        $orientation_file = new OrientationFile();
        $orientation_file->name = $request->name;
        $orientation_file->path = $request->path;
        $orientation_file->is_active = $request->is_active ?? true;
        $orientation_file->type = $request->type;
        $orientation_file->created_by = $user_identification;
        $orientation_file->updated_by = $request->updated_by ?? null;
        $orientation_file->rank_id = $request->rank_id;
        $orientation_file->user_id = $user->id;
        $orientation_file->company_id = $user->company_id ?? null;
        $orientation_file->updated_by = $request->updated_by ?? $user_identification;
        $orientation_file->save();
        return new OrientationFileResource($orientation_file);
    }

    function update(Request $request, int $id)
    {
        $user = $request->user();
        $orientation_file = OrientationFile::findOrFail($id);
        $orientation_file->name = $request->name ?? $orientation_file->name;
        $orientation_file->path = $request->path ?? $orientation_file->path;
        $orientation_file->is_active = $request->is_active ?? $orientation_file->is_active;
        $orientation_file->type = $request->type ?? $orientation_file->type;
        $orientation_file->created_by = $orientation_file->created_by;
        $orientation_file->updated_by = $user->identification ?? $orientation_file->updated_by;
        $orientation_file->rank_id = $request->rank_id ?? $orientation_file->rank_id;
        $orientation_file->user_id = $user->id ?? $orientation_file->user_id;
        $orientation_file->company_id = $user->company_id ?? $orientation_file->company_id;
        $orientation_file->save();
        return new OrientationFileResource($orientation_file);
    }

    function destroy(int $id)
    {
        $orientation_file = OrientationFile::findOrFail($id);
        $orientation_file->delete();
        return new OrientationFileResource($orientation_file);
    }

    function restore(int $id)
    {
        $orientation_file = OrientationFile::onlyTrashed()->findOrFail($id);
        $orientation_file->restore();
        return new OrientationFileResource($orientation_file);
    }

    function get_permittet_files(Request $request)
    {
        $user = $request->user();
        try {
            $orientation_file_permissions = OrientationFilePermission::where('user_id', $user->id)->get();
            $orientation_files = OrientationFile::all();
            $orientation_files = $orientation_files->filter(function ($orientation_file) use ($orientation_file_permissions, $user) {
                foreach ($orientation_file_permissions as $orientation_file_permission) {
                    if ($orientation_file->id == $orientation_file_permission->orientation_file_id) {
                        return true;
                    }
                }
                if ($orientation_file->company_id != null) {
                    if ($orientation_file->company_id == $user->company_id) {
                        if ($orientation_file->rank != null) {
                            if ($orientation_file->rank->level <= $user->rank->level) {
                                return true;
                            }
                        }
                        else {
                            return true;
                        }
                    }
                }
                else {
                    if ($orientation_file->rank->level <= $user->rank->level) {
                        return true;
                    }
                }
            });
            return OrientationFileResource::collection($orientation_files);
        } catch (\Throwable $th) {
            // Return the error
            return response()->json(['message' => $th->getMessage()], 404);
            return response()->json(['message' => 'No files found'], 404);
        }
    }
}
