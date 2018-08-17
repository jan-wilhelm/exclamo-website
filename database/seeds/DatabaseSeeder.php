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
        $roles = ['schueler', 'lehrer', 'schulleiter', 'admin'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        echo "Creating schools... \n";
        $schools = factory(App\School::class, 3)->create();

        $locations = array();

        foreach (App\School::all() as $school) {
            echo "Creating users... \n";
            $users = factory(App\User::class, 40)->create([
                'school_id'=> $school->id
            ]);

            echo "Assigning roles to users... \n";
            $index = 0;
            foreach ($users as $user) {
                $school->students()->save($user);
                $index += 1;
                if ($index < 30) {
                    $user->assignRole("schueler");
                } elseif ($index < 39) {
                    $user->assignRole("lehrer");
                } else {
                    $user->assignRole("schulleiter");
                }
            }

            echo "Creating locations... \n";
            $location = factory(App\Location::class)->create([
                'school_id'=> $school->id
            ]);

            $locations[] = $location;

            $school->locations()->save($location);
        }


        $students = App\User::role('schueler')->get();
        $mentors = App\User::role('lehrer')->get();

        foreach ($students as $student) {

            echo "Creating cases... \n";
            $cases = factory(App\ReportedCase::class, 3)->create([
                'student_id'=> $student->id
            ]);

            foreach ($cases as $case) {
                $case->location()->associate($locations[array_rand($locations)]);
                $case->mentors()->save($mentors->random(1)[0]);
                $student->reportedCases()->save($case);

                echo "Creating messages... \n";
                $messages = factory(App\Message::class, 15)->make()->each(function($m) use ($case, $student) {
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
