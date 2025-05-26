namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    public function index()
    {
        $grades = Grade::with('student')->get();
        return view('grades.list', compact('grades'));
    }

    public function create()
    {
        $grade = new Grade();
        $students = User::where('role_id', 3)->get(); // Assuming role_id 3 is for students
        return view('grades.edit', compact('grade', 'students'));
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = User::where('role_id', 3)->get(); // Assuming role_id 3 is for students
        return view('grades.edit', compact('grade', 'students'));
    }

    public function save(Request $request, $id = null)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required',
            'grade' => 'required|in:A+,A,A-,B+,B,B-,C+,C,C-,D+,D,F',
        ]);

        if ($id) {
            $grade = Grade::findOrFail($id);
        } else {
            $grade = new Grade();
        }

        $grade->student_id = $request->student_id;
        $grade->course_id = $request->course_id;
        $grade->grade = $request->grade;
        $grade->save();

        return redirect()->route('grades_list')->with('success', 'Grade saved successfully');
    }

    public function delete($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();
        return redirect()->route('grades_list')->with('success', 'Grade deleted successfully');
    }
} 