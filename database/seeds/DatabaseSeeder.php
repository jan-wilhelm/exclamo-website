<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        echo "Creating roles... \n";
        $roles = ['schueler', 'lehrer', 'schulleiter'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        echo "Creating schools... \n";
        $roleCounts = [
            'schueler'=> 0,
            'lehrer'=> 0,
            'schulleiter'=> 0
        ];
        $schools = factory(App\School::class, 2)->create();

        foreach (App\School::all() as $school) {
            echo "Creating users... \n";
            $users = factory(App\User::class, 100)->make([
                'school_id'=> $school->id
            ]);

            echo "Assigning roles to users... \n";
            $index = 0;
            foreach ($users as $user) {
                $index += 1;
                if ($index < 90) {
                    $role = "schueler";
                } elseif ($index < 98) {
                    $role = "lehrer";
                } else {
                    $role = "schulleiter";
                }

                $user->email = $role . $roleCounts[$role] . "@example.com";
                $user->save();
                $user->assignRole($role);

                $school->students()->save($user);

                $roleCounts[$role]++;

                $logins = factory(App\LoginActivity::class, 50)->create([
                    'user_id'=> $user->id
                ]);
            }

            echo "Creating locations... \n";
            $locations = factory(App\Location::class, 5)->create([
                'school_id'=> $school->id
            ]);

            $school->locations()->saveMany($locations);
        }


        $students = App\User::role('schueler')->get();
        $mentors = App\User::role(['lehrer', 'schulleiter'])->mentoring()->get();

        foreach ($students as $student) {

            echo "Creating cases... \n";
            $cases = factory(App\ReportedCase::class, rand(1,10))->create([
                'student_id'=> $student->id
            ]);

            $locations = $student->school->locations;

            foreach ($cases as $case) {
                $case->location()->associate($locations->random());
                $case->mentors()->save($mentors->random(1)[0]);
                $student->reportedCases()->save($case);

                echo "Creating messages... \n";
                $messages = factory(App\Message::class, rand(1,4))->make()->each(function($m) use ($case, $student) {
                    $sender = array( $case->mentors[0], $student )[random_int(0, 1)];
                    $m->sender()->associate($sender);
                    $case->messages()->save($m);
                    $m->save();
                });

                $case->updated_at = $messages->sortByDesc("updated_at")->first()->updated_at;
                $case->save();
            }
        }
    }
}
