<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\File;
use App\Models\Member;
use App\Models\Entry;
use App\Models\User;
use App\Models\Law;
use App\Models\FileLaw;
use App\Models\Rank;
use App\Models\Institution;
use App\Models\Permission;
use App\Models\Logistic;
use App\Models\Health;
use App\Models\Patient;
use App\Models\Publish;
use App\Models\Company;
use App\Models\SecurityLevel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Erstelle ein Sicherheitslevel

        $securityLevels = [
            (object) [
                'level' => '1',
                'abbreviation' => 'Delta',
            ],
            (object) [
                'level' => '2',
                'abbreviation' => 'Charlie-2',
            ],
            (object) [
                'level' => '3',
                'abbreviation' => 'Charlie-1',
            ],
            (object) [
                'level' => '4',
                'abbreviation' => 'Bravo',
            ],
            (object) [
                'level' => '5',
                'abbreviation' => 'Alpha',
            ],
            (object) [
                'level' => '6',
                'abbreviation' => 'Zulu',
            ],
        ];

        $laws = [
            (object) [
                "Title" => "Beleidigung",
                "Category" => "1",
                "Severity" => "High",
                "ShortDescription" => "Ein Angriff auf die Person durch verbale Worten oder Taten wird als Beleidigung gezählt.",
                "Description" => "Die Aussagen einer Person werden nach Ermessen der Exekutive behandelt.",
                "minJail" => 0,
                "maxJail" => 10
            ],
            (object) [
                "Title" => "Respektlosigkeit",
                "Category" => "1",
                "Severity" => "High",
                "ShortDescription" => "Eine Respektlosigkeit oder Untergraben des Respekts einer Person kann von der Exekutive als Beleidigung deklariert werden.",
                "Description" => "Die Maximale Strafe beläuft sich auf: 10 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 10
            ],
            (object) [
                "Title" => "Leichter Diebstahl",
                "Category" => "1",
                "Severity" => "Medium",
                "ShortDescription" => "Ein leichter Diebstahl beläuft sich auf ein sehr geringes Entwenden einer nicht wichtigen Ressource.",
                "Description" => "Die Maximale Strafe beläuft sich auf: 10 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 10
            ],
            (object) [
                "Title" => "Undiszipliniertes Verhalten",
                "Category" => "1",
                "Severity" => "High",
                "ShortDescription" => "Als Undiszipliniertes Verhalten zählt unter anderem die Respektlosigkeit gegenüber Nieder- / Gleich- und Höherrangigen oder ein falsches Verhalten zeigen.",
                "Description" => "Die Maximale Strafe beläuft sich auf: Zur Grundausbildung auf Kamino schicken oder Haftzeit: 10 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 10
            ],
            (object) [
                "Title" => "Verstoß gegen Sicherheitslevel",
                "Category" => "1",
                "Severity" => "High",
                "ShortDescription" => "Ein Verstoß gegen das Sicherheitslevel bezeichnet das Betreten einer Anlage bzw. eines Bereiches mit einem höheren Sicherheitslevel als das Eigene.",
                "Description" => "Die Maximale Strafe beläuft sich auf: 15 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 15
            ],
            (object) [
                "Title" => "Entziehung vor Sanktionen",
                "Category" => "2",
                "Severity" => "High",
                "ShortDescription" => "Wer sich seiner Sanktion entzieht, als Beispiel: Bußgeld wissentlich nicht bezahlen oder das Shuttle nach Kamino trotz Auflage nicht nehmen, macht sich strafbar.",
                "Description" => "Die Maximale Strafe beläuft sich auf: 20 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 20
            ],
            (object) [
                "Title" => "Schwerer Diebstahl",
                "Category" => "2",
                "Severity" => "High",
                "ShortDescription" => "Schwerer Diebstahl bezeichnet das Entwenden von großen, vielen und/oder wichtigen Ressourcen.",
                "Description" => "Beispiel: Das Entwenden eines schweren Ionen Disruptors aus der Waffenkammer.\nDie Maximale Strafe beläuft sich auf: 20 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 20
            ],
            (object) [
                "Title" => "Belästigung",
                "Category" => "2",
                "Severity" => "High",
                "ShortDescription" => "Das Belästigen von Personen oder Personengruppen kann auch als undiszipliniertes Verhalten angesehen werden.",
                "Description" => "Als Belästigung wird das stören oder nerven von Personen genannt.\nDie Maximale Strafe beläuft sich auf: 20 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 20
            ],
            (object) [
                "Title" => "Verstoß der Start- / Landeerlaubnis Richtlinien",
                "Category" => "2",
                "Severity" => "High",
                "ShortDescription" => "Die Richtlinie besagt dass: “Zu startende oder landende Personen müssen ihr Anliegen erst anfragen bevor sie zum Start bzw. zur Landung ansetzen.",
                "Description" => "Dabei wird ihnen ein Flugplatz zugewiesen, den sie benutzen können. Sollte keine solche Anfrage erfolgen, können Konsequenzen je nach Schweregrad bis zur Zerstörung des Fahrzeuges folgen.\nDie Maximale Strafe beläuft sich auf: 30 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 30
            ],
            (object) [
                "Title" => "Unbefugtes Benutzen einer Ressource",
                "Category" => "2",
                "Severity" => "High",
                "ShortDescription" => "Das unbefugte benutzen einer Ressource bezeichnet das benutzen einer Ressource wie z.B. das benutzen eines AT-TE ohne Erlaubnis oder Ausbildung.",
                "Description" => "Die Maximale Strafe beläuft sich auf: 25 Hafteinheiten, Entzug aus jeglichen Fortbildungen für Fahrzeuge",
                "minJail" => 0,
                "maxJail" => 25
            ],
            (object) [
                "Title" => "Widerstand gegen die Exekutive",
                "Category" => "2",
                "Severity" => "High",
                "ShortDescription" => "Als Widerstand gegen die Exekutive ist das Nichtbefolgen der Anweisungen der Exekutiven Kraft oder das Aktive zur Wehr setzen gegen natürliche oder juristische Personen der Exekutiven Kraft gemeint.",
                "Description" => "Die Maximale Strafe beläuft sich auf: 20 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 20
            ],
            (object) [
                "Title" => "Behinderung der Notfall Kräfte",
                "Category" => "2",
                "Severity" => "High",
                "ShortDescription" => "Notfall Kräfte, die aktiv oder passiv von Personen behindert werden, können Maßnahmen gegebenenfalls verzögern.",
                "Description" => "Der Fall stellt eine Straftat dar.\nDie Maximale Strafe beläuft sich auf: 20 Hafteinheiten",
                "minJail" => 0,
                "maxJail" => 20
            ],
        ];

        $ranks = [
            (object) [
                'rank' => 'Private',
                'kader' => 'Enlisted',
                'unit' => 'Clone Army',
                'abbreviation' => 'PVT',
                'level' => '1',
                'security_level_id' => '1',
            ],
            (object) [
                'rank' => 'Private First Class',
                'kader' => 'Enlisted',
                'unit' => 'Clone Army',
                'abbreviation' => 'PFC',
                'level' => '2',
                'security_level_id' => '1',
            ],
            (object) [
                'rank' => 'Specialist',
                'kader' => 'Enlisted',
                'unit' => 'Clone Army',
                'abbreviation' => 'SPC',
                'level' => '3',
                'security_level_id' => '1',
            ],
            (object) [
                'rank' => 'Lance Corporal',
                'kader' => 'Enlisted',
                'unit' => 'Clone Army',
                'abbreviation' => 'LCPL',
                'level' => '4',
                'security_level_id' => '1',
            ],
            (object) [
                'rank' => 'Corporal',
                'kader' => 'Junior NCO',
                'unit' => 'Clone Army',
                'abbreviation' => 'CPL',
                'level' => '5',
                'security_level_id' => '2',
            ],
            (object) [
                'rank' => 'Sergeant',
                'kader' => 'Junior NCO',
                'unit' => 'Clone Army',
                'abbreviation' => 'SGT',
                'level' => '6',
                'security_level_id' => '2',
            ],
            (object) [
                'rank' => 'Staff Sergeant',
                'kader' => 'Junior NCO',
                'unit' => 'Clone Army',
                'abbreviation' => 'SSGT',
                'level' => '7',
                'security_level_id' => '2',
            ],
            (object) [
                'rank' => 'Technical Sergeant',
                'kader' => 'Senior NCO',
                'unit' => 'Clone Army',
                'abbreviation' => 'TSGT',
                'level' => '8',
                'security_level_id' => '3',
            ],
            (object) [
                'rank' => 'Master Sergeant',
                'kader' => 'Senior NCO',
                'unit' => 'Clone Army',
                'abbreviation' => 'MSGT',
                'level' => '9',
                'security_level_id' => '3',
            ],
            (object) [
                'rank' => 'First Sergeant',
                'kader' => 'Senior NCO',
                'unit' => 'Clone Army',
                'abbreviation' => '1SGT',
                'level' => '10',
                'security_level_id' => '3',
            ],
            (object) [
                'rank' => 'Sergeant Major',
                'kader' => 'Senior NCO',
                'unit' => 'Clone Army',
                'abbreviation' => 'SGM',
                'level' => '11',
                'security_level_id' => '3',
            ],
            (object) [
                'rank' => '2nd Lieutenant',
                'kader' => 'Commissioned Officer',
                'unit' => 'Clone Army',
                'abbreviation' => '2LT',
                'level' => '12',
                'security_level_id' => '4',
            ],
            (object) [
                'rank' => '1st Lieutenant',
                'kader' => 'Commissioned Officer',
                'unit' => 'Clone Army',
                'abbreviation' => '1LT',
                'level' => '13',
                'security_level_id' => '4',
            ],
            (object) [
                'rank' => 'Captain',
                'kader' => 'Commissioned Officer',
                'unit' => 'Clone Army',
                'abbreviation' => 'CPT',
                'level' => '14',
                'security_level_id' => '4',
            ],
            (object) [
                'rank' => 'Major',
                'kader' => 'Commissioned Officer',
                'unit' => 'Clone Army',
                'abbreviation' => 'MAJ',
                'level' => '15',
                'security_level_id' => '5',
            ],
            (object) [
                'rank' => 'Commander',
                'kader' => 'Commissioned Officer',
                'unit' => 'Clone Army',
                'abbreviation' => 'CMD',
                'level' => '16',
                'security_level_id' => '5',
            ],
            (object) [
                'rank' => 'Senior Commander',
                'kader' => 'Commissioned Officer',
                'unit' => 'Clone Army',
                'abbreviation' => 'SCMD',
                'level' => '17',
                'security_level_id' => '5',
            ],
            (object) [
                'rank' => 'Marshal Commander',
                'kader' => 'Commissioned Officer',
                'unit' => 'Clone Army',
                'abbreviation' => 'MCMD',
                'level' => '18',
                'security_level_id' => '5',
            ],
            (object) [
                'rank' => 'Colonel',
                'kader' => 'High Command',
                'unit' => 'Clone Army',
                'abbreviation' => 'COL',
                'level' => '19',
                'security_level_id' => '6',
            ],
            (object) [
                'rank' => 'Crewman',
                'kader' => 'Enlisted',
                'unit' => 'Navy',
                'abbreviation' => 'CM',
                'level' => '1',
                'security_level_id' => '1',
            ],
            (object) [
                'rank' => 'Petty Officer',
                'kader' => 'Enlisted',
                'unit' => 'Navy',
                'abbreviation' => 'PO',
                'level' => '2',
                'security_level_id' => '1',
            ],
            (object) [
                'rank' => 'Chief Petty Officer',
                'kader' => 'Enlisted',
                'unit' => 'Navy',
                'abbreviation' => 'CPO',
                'level' => '3',
                'security_level_id' => '1',
            ],
            (object) [
                'rank' => 'Warrent Officer',
                'kader' => 'Junior NCO',
                'unit' => 'Navy',
                'abbreviation' => 'WO',
                'level' => '4',
                'security_level_id' => '2',
            ],
            (object) [
                'rank' => 'Chief Warrent Officer',
                'kader' => 'Junior NCO',
                'unit' => 'Navy',
                'abbreviation' => 'CWO',
                'level' => '5',
                'security_level_id' => '2',
            ],
            (object) [
                'rank' => 'Ensign',
                'kader' => 'Junior NCO',
                'unit' => 'Navy',
                'abbreviation' => 'ENS',
                'level' => '6',
                'security_level_id' => '2',
            ],
            (object) [
                'rank' => 'Mindshipman',
                'kader' => 'Senior NCO',
                'unit' => 'Navy',
                'abbreviation' => 'MSM',
                'level' => '7',
                'security_level_id' => '3',
            ],
            (object) [
                'rank' => 'Lieutenant',
                'kader' => 'Senior NCO',
                'unit' => 'Navy',
                'abbreviation' => 'LT',
                'level' => '8',
                'security_level_id' => '3',
            ],
            (object) [
                'rank' => 'Lieutenant Commander',
                'kader' => 'Senior NCO',
                'unit' => 'Navy',
                'abbreviation' => 'LTC',
                'level' => '9',
                'security_level_id' => '3',
            ],
            (object) [
                'rank' => 'Commander',
                'kader' => 'Commissioned Officer',
                'unit' => 'Navy',
                'abbreviation' => 'CMD',
                'level' => '10',
                'security_level_id' => '4',
            ],
            (object) [
                'rank' => 'Captain',
                'kader' => 'Commissioned Officer',
                'unit' => 'Navy',
                'abbreviation' => 'CPT',
                'level' => '11',
                'security_level_id' => '5',
            ],
            (object) [
                'rank' => 'Commodore',
                'kader' => 'Commissioned Officer',
                'unit' => 'Navy',
                'abbreviation' => 'COM',
                'level' => '12',
                'security_level_id' => '6',
            ],
            (object) [
                'rank' => 'Administration',
                'kader' => 'Administration',
                'unit' => 'Administration',
                'abbreviation' => 'ADM',
                'level' => '100',
                'security_level_id' => '6',
            ],
        ];

        $companies = [
            (object) [
                'company' => '1st Infantry Company',
                'abbreviation' => '1st',
                'highestLevel' => '18',
            ],
            (object) [
                'company' => '14th Infantry Company',
                'abbreviation' => '14th',
                'highestLevel' => '12',
            ],
            (object) [
                'company' => '8th Medic Company',
                'abbreviation' => '8th',
                'highestLevel' => '12',
            ],
            (object) [
                'company' => '23rd Pilot Company',
                'abbreviation' => '23rd',
                'highestLevel' => '12',
            ],
            (object) [
                'company' => '5th Scout Company',
                'abbreviation' => '5th',
                'highestLevel' => '12',
            ],
            (object) [
                'company' => '13th Element Navy',
                'abbreviation' => 'Navy',
                'highestLevel' => '12',
            ],
            (object) [
                'company' => 'Engineering Corps',
                'abbreviation' => 'EC',
                'highestLevel' => '12',
            ],
            (object) [
                'company' => 'Shock Trooper',
                'abbreviation' => 'ST',
                'highestLevel' => '12',
            ],
            (object) [
                'company' => 'Republikanisches Zentrum für Informationstechnologie',
                'abbreviation' => 'RZIT',
                'highestLevel' => '19',
            ],
        ];

        $institutions = [
            (object) [
                'name' => 'Repulikanischer Senat',
                'description' => 'Der Republikanische Senat ist die Legislative der Galaktischen Republik. Er ist der Nachfolger des Galaktischen Senats der Alten Republik.',
                'abbreviation' => 'RS',
            ],
            (object) [
                'name' => 'Jedi Orden',
                'description' => 'Der Jedi-Orden ist eine religiöse Organisation, die sich der Macht verschrieben hat. Die Jedi sind die Hüter des Friedens und der Gerechtigkeit in der Galaxis.',
                'abbreviation' => 'JO',
            ],
            (object) [
                'name' => 'Republikanisches Zentrum für innere Sicherheit',
                'description' => 'Das Republikanische Zentrum für innere Sicherheit ist eine Organisation, die sich mit der inneren Sicherheit der Republik befasst.',
                'abbreviation' => 'RZIS',
            ],
            (object) [
                'name' => 'Republikanisches Zentrum für Bildung und Wissenschaft',
                'description' => 'Das Republikanische Zentrum für Bildung und Wissenschaft ist eine Organisation, die sich mit der Bildung und Wissenschaft der Republik befasst.',
                'abbreviation' => 'RZBIW',
            ],
            (object) [
                'name' => 'Republikanisches Zentrum für Äußere Angelegenheiten',
                'description' => 'Das Republikanische Zentrum für Äußere Angelegenheiten ist für die Außenpolitik der Republik zuständig.',
                'abbreviation' => 'RZfA',
            ],
            (object) [
                'name' => 'Republikanisches Zentrum für Gesundheit',
                'description' => 'Das Republikanische Zentrum für Gesundheit ist eine Organisation, die sich mit der Gesundheit der Republik befasst.',
                'abbreviation' => 'RZG',
            ],
            (object) [
                'name' => 'Republikanisches Zentrum für Informationstechnologie',
                'description' => 'Das Republikanische Zentrum für Informationstechnologie ist eine Organisation, die sich mit der Informationstechnologie der Republik befasst.',
                'abbreviation' => 'RZIT',
            ],
            ];

        $logistics = [
            (object) [
                'name' => 'LAAT/i',
                'description' => 'Der Low Altitude Assault Transport/infantry (kurz: LAAT/i) ist ein von Rothana Heavy Engineering für die Große Armee der Republik entwickelter und produzierter Transporter.',
                'stock' => '10',
                'ordered' => '0',
                'inUse' => '7',
                'price' => '85000',
            ],
            (object) [
                'name' => 'LAAT/c',
                'description' => 'Der Low Altitude Assault Transport/carrier (kurz: LAAT/c) ist ein von Rothana Heavy Engineering für die Große Armee der Republik entwickelter und produzierter Transporter.',
                'stock' => '5',
                'ordered' => '0',
                'inUse' => '0',
                'price' => '58000',
            ],
            (object) [
                'name' => 'TX-130',
                'description' => 'Der TX-130 Saber-Klasse Kampfpanzer ist ein von Rothana Heavy Engineering für die Große Armee der Republik entwickelter und produzierter Kampfpanzer.',
                'stock' => '15',
                'ordered' => '5',
                'inUse' => '7',
                'price' => '85000',
            ],
            (object) [
                'name' => 'AT-TE',
                'description' => 'Der All Terrain Tactical Enforcer (kurz: AT-TE) ist ein von Rothana Heavy Engineering für die Große Armee der Republik entwickelter und produzierter Kampfläufer.',
                'stock' => '10',
                'ordered' => '5',
                'inUse' => '1',
                'price' => '300000',
            ],
            (object) [
                'name' => 'AT-RT',
                'description' => 'Der All Terrain Recon Transport (kurz: AT-RT) ist ein von Kuat Drive Yards für die Große Armee der Republik entwickelter und produzierter Kampfläufer.',
                'stock' => '33',
                'ordered' => '7',
                'inUse' => '3',
                'price' => '15000',
            ],
        ];

        foreach ($securityLevels as $securityLevel) {
            SecurityLevel::factory()->create([
                'level' => $securityLevel->level,
                'abbreviation' => $securityLevel->abbreviation,
            ]);
        }

        foreach ($companies as $company) {
            Company::factory()->create([
                'company' => $company->company,
                'abbreviation' => $company->abbreviation,
                'highestLevel' => $company->highestLevel,
            ]);
        }

        foreach ($logistics as $logistic)
        {
            Logistic::factory()->create([
                'name' => $logistic->name,
                'description' => $logistic->description,
                'stock' => $logistic->stock,
                'ordered' => $logistic->ordered,
                'inuse' => $logistic->inUse,
                'price' => $logistic->price,
            ]);
        }

        foreach ($ranks as $rank) {
            Rank::factory()->create([
                'rank' => $rank->rank,
                'kader' => $rank->kader,
                'unit' => $rank->unit,
                'abbreviation' => $rank->abbreviation,
                'level' => $rank->level,
                'security_level_id' => $rank->security_level_id,
            ]);
        }

        User::factory()->create([
            'name' => 'CT-6659',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'identification' => 'CT-6659',
            'restrictionClass' => '10',
            'company_id' => '1',
            'isActive' => True,
            'rank_id' => '15',
            'discord' => '821117158012354570',
            'permission_superadmin' => True,
        ]);

        User::factory()->create([
            'name' => 'Jyods',
            'email' => 'Jyods@test.com',
            'password' => bcrypt('password'),
            'identification' => 'Jyods',
            'restrictionClass' => '2',
            'company_id' => '1',
            'isActive' => True,
            'rank_id' => '1',
            'discord' => '345665041477140490'
        ]);

        Entry::factory()->count(20)->create();
        User::factory()->count(5)->create();

        File::factory()
        ->count(50)
        ->create();

        foreach ($laws as $law) {
            Law::factory()->create([
                'Title' => $law->Title,
                'Category' => $law->Category,
                'Severity' => $law->Severity,
                'ShortDescription' => $law->ShortDescription,
                'Description' => $law->Description,
                'minJail' => $law->minJail,
                'maxJail' => $law->maxJail,
            ]);
        }

        //Law::factory(20)->create();

        FileLaw::factory()
        ->count(100)
        ->create();

        foreach($institutions as $institution) {
            Institution::factory()->create([
                'name' => $institution->name,
                'description' => $institution->description,
                'abbreviation' => $institution->abbreviation,
            ]);
        }

        Permission::factory(10)->create();
        
        Patient::factory(10)->create();

        Health::factory(10)->create();


        //Logistic::factory(10)->create();


        /*Member::factory()
        ->count(30)
        ->has(File::factory()->count(2))
        ->create();*/
    }
}
