<?php 
namespace App\Http\Controllers;

use App\Models\User; // Use the correct model for the users table
use App\Models\Student; // For the students table
use App\Models\StudentSubject;
use App\Models\Subject; // For the subject table
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function createStudent(Request $request)
    {
        try {
            // Validate the incoming request data for both tables
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:users,email',
                'password' => 'nullable|string|min:8|max:255',
                'address' => 'nullable|string|max:255',
                'year_level' => 'nullable|string|max:255',
            ]);

            // Hash the password for the user
            $validated['password'] = Hash::make($validated['password']);

            // Create a new user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            // Create a new student record
            $student = Student::create([
                'user_id' => $user->id, // Link the student to the user
                'name' => $validated['name'],
                'address' => $validated['address'],
                'year_level' => $validated['year_level'],
            ]);

            // Return the newly created user and student data
            return response()->json([
                'user' => $user,
                'student' => $student,
            ], 201);

        } catch (\Exception $e) {
            // Return error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function editStudent(Request $request, $id)
    {
        try {
            // Validate the incoming request data for both tables
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|max:255',
                'address' => 'nullable|string|max:255',
                'year_level' => 'nullable|string|max:255',
            ]);

            // Find the user record
            $user = User::findOrFail($id);

            // Update user data
            if (isset($validated['name'])) {
                $user->name = $validated['name'];
            }
            if (isset($validated['email'])) {
                $user->email = $validated['email'];
            }
            if (isset($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();

            // Find the student record linked to this user
            $student = Student::where('user_id', $id)->firstOrFail();

            // Update student data

            if (isset($validated['name'])) {
                $student->name = $validated['name'];
            }

            if (isset($validated['address'])) {
                $student->address = $validated['address'];
            }
            if (isset($validated['year_level'])) {
                $student->year_level = $validated['year_level'];
            }
            $student->save();

            // Return the updated user and student data
            return response()->json([
                'user' => $user,
                'student' => $student,
            ], 200);

        } catch (\Exception $e) {
            // Return error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Get all students
    public function getAllStudents()
    {
        try {
            // Fetch all students with their associated user data
            $students = Student::with('user')->get();

            return response()->json($students, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Get a specific student by ID
    public function getStudentById($id)
    {
        try {
            // Fetch the student with the specified ID and associated user data
            $student = Student::with('user')->findOrFail($id);

            return response()->json($student, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Student not found or another error occurred'], 404);
        }
    }

    public function deleteStudent($id)
    {
        try {
            // Find the student record
            $student = Student::findOrFail($id);

            // Find the associated user record
            $user = $student->user;

            // Delete the student record first
            $student->delete();

            // Delete the associated user record
            if ($user) {
                $user->delete();
            }

            return response()->json(['message' => 'Student and associated user deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Student not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }


    public function addSubjects(Request $request)
    {
        try {
            // Validate the incoming request data for both tables
            $validated = $request->validate([
                'subject_name' => 'nullable|string|max:255',
                'subject_description' => 'nullable|string|max:255',
            ]);

            // Create a new user
            $subject = Subject::create([
                'subject_name' => $validated['subject_name'],
                'subject_description' => $validated['subject_description'],
            ]);

            // Return the newly created user and student data
            return response()->json([
                'subject' => $subject,
            ], 201);

        } catch (\Exception $e) {
            // Return error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addSubjectToStudent(Request $request, $studentID)
    {
        $student = Student::find($studentID);
        $validated = $request->validate([
            'subject_id' => 'nullable|string',
        ]);
        $return = $student->subjects()->attach( $validated['subject_id'] );
        return $return;
    }

    // public function addSubjectToStudent1(Request $request, $studentID)
    // {
    //     // Find the student by ID
    //     $student = Student::findOrFail($studentID);  // Ensure the student exists

    //     // Validate the incoming request for subject_id
    //     $validated = $request->validate([
    //         'subject_id' => 'required|exists:subjects,id',  // Ensure subject_id is provided and exists in the subjects table
    //     ]);

    //     // Attach the subject to the student
    //     $student->subjects()->attach($validated['subject_id']);

    //     // Return a success message or the updated relationship
    //     return response()->json([
    //         'message' => 'Subject added successfully to the student.',
    //         'student' => $student->load('subjects'),  // Optionally return the updated student with their subjects
    //     ], 200);
    // }

}