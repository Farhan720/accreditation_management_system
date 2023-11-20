<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Department;
use App\Semester;
use App\Subject;
use App\Section;
use App\Student;
use App\Teacher;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // DB::table(with(new User())->getTable())->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
//        DB::statement("TRUNCATE TABLE ".(new User())->getTable()." RESTART IDENTITY CASCADE");

 //       $user = User::where('email','admin@macrotechgroups.com')->first();

        if(!isset($user)){
            $user = User::create([
               'user_id' => 0,
               'name' => 'Admin',
               'email' => 'admin@gmail.com',
               'password' => bcrypt('admin'),
               'type' => 'admin'
            ]);
          
            $user = User::create([
               'user_id' => 0,
                'name' => 'student',
                'email' => 'student@gmail.com',
                'password' => bcrypt('student'),
                'type' => 'student'
             ]);
            
             $user = User::create([
               'user_id' => 0,
                'name' => 'teacher',
                'email' => 'teacher@gmail.com',
                'password' => bcrypt('teacher'),
                'type' => 'teacher'
             ]);
             $department = Department::create([
              
                'department_name' => 'Computer scince'
             
             ]);
             $department = Department::create([
              
               'department_name' => 'Software Engineering'
            
            ]);
            $semester = Semester::create([
               'department_id' => '1',
               'semester_name' => '1'
            
            ]);
            $semester = Semester::create([
               'department_id' => '1',
               'semester_name' => '2'
            
            ]);
            $subject = Subject::create([
               'department_id' => '1',
               'semester_id' => '1',
               'subject_name' => 'DLD'
            
            ]);
            $subject = Subject::create([
               'department_id' => '1',
               'semester_id' => '1',
               'subject_name' => 'Compiler'
            
            ]);
            $section = Section::create([
               'department_id' => '1',
               'semester_id' => '1',
               'section_name' => 'A'
            
            ]); 
            $section = Section::create([
               'department_id' => '1',
               'semester_id' => '1',
               'section_name' => 'B'
            
            ]); 
            $student = Student::create([
               'department_id' => '1',
               'first_name' => 'Ali',
               'last_name' => 'Raza',
               'email' => 'student1@gmail.com',
               'cell' => '03001234567',
               'qualification' => 'BS.CS',
               'address' => 'Lahore',
            
            ]); 
            $student = Student::create([
               'department_id' => '1',
               'first_name' => 'Kasahif',
               'last_name' => 'Ali',
               'email' => 'student2@gmail.com',
               'cell' => '03001234567',
               'qualification' => 'BS.CS',
               'address' => 'Lahore',
            
            ]); 
            $teacher = Teacher::create([
               'department_id' => '1',
               'first_name' => 'Muhammad',
               'last_name' => 'Zaman',
               'email' => 'teacher1@gmail.com',
               'cell' => '03001234567',
               'qualification' => 'BS.CS',
               'address' => 'Lahore',
            
            ]); 
            $teacher = Teacher::create([
               'department_id' => '1',
               'first_name' => 'Dr',
               'last_name' => 'Imran',
               'email' => 'teacher2@gmail.com',
               'cell' => '03001234567',
               'qualification' => 'BS.CS',
               'address' => 'Lahore',
            
            ]); 
        }

       // factory(User::class, 50)->create();
    }

}
