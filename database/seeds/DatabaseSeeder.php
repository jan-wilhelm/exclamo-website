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
            $locations = factory(App\Location::class, 5)->create([
                'school_id'=> $school->id
            ]);

            $school->locations()->saveMany($locations);
        }


        $students = App\User::role('schueler')->get();
        $mentors = App\User::role(['lehrer', 'schulleiter'])->mentoring()->get();

        foreach ($students as $student) {

            echo "Creating cases... \n";
            $cases = factory(App\ReportedCase::class, 3)->create([
                'student_id'=> $student->id
            ]);

            $locations = $student->school->locations;

            foreach ($cases as $case) {
                $case->location()->associate($locations->random());
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
