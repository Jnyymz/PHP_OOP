<?php
class Student {
    private string $name;
    private array $courses = [];
    private float $courseFee = 1450; 

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function addCourse(string $course): void {
        if (!in_array($course, $this->courses)) {
            $this->courses[] = $course;
            echo "Course '$course' added.\n";
        } else {
            echo "Course '$course' is already enrolled.\n";
        }
    }

    public function deleteCourse(string $course): void {
        $index = array_search($course, $this->courses);
        if ($index !== false) {
            unset($this->courses[$index]);
            $this->courses = array_values($this->courses); // reindex
            echo "Course '$course' deleted.\n";
        } else {
            echo "Course '$course' is not enrolled.\n";
        }
    }

    public function getTotalFee(): float {
        return count($this->courses) * $this->courseFee;
    }

    public function displayInfo(): void {
        echo "\n--- Student Info ---\n";
        echo "Student: {$this->name}\n";
        echo "Enrolled Courses: " . (empty($this->courses) ? "None" : implode(", ", $this->courses)) . "\n";
        echo "Total Fee: PHP " . $this->getTotalFee() . "\n";
    }
}

$studentName = readline("Enter student name: ");
$student = new Student($studentName);

while (true) {
    echo "\nChoose an option:\n";
    echo "1. Add Course\n";
    echo "2. Delete Course\n";
    echo "3. Show Student Info\n";
    echo "4. Exit\n";
    $choice = readline("Enter choice (1-4): ");

    switch ($choice) {
        case "1":
            $course = readline("Enter course name to add: ");
            $student->addCourse($course);
            break;
        case "2":
            $course = readline("Enter course name to delete: ");
            $student->deleteCourse($course);
            break;
        case "3":
            $student->displayInfo();
            break;
        case "4":
            echo "Exiting program...\n";
            $student->displayInfo();
            exit;
        default:
            echo "Invalid choice. Please try again.\n";
    }
}
