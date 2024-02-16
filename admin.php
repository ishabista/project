<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>

    <h2>Admin Panel</h2>

    <table id="adminAppointmentsTable">
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display approved appointments
            $appointments = fetchAppointments();
            foreach ($appointments as $appointment) {
                if ($appointment['status'] === 'approved') {
                    echo "<tr>";
                    echo "<td>{$appointment['destination']}</td>";
                    echo "<td>{$appointment['guestname']}</td>";
                    echo "<td>{$appointment['arrivaldate']}</td>";
                    echo "<td>{$appointment['leavingdate']}</td>";
                    echo "<td>{$appointment['contact']}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <script>
        // Fetch and display approved appointments when the page loads
        window.onload = function () {
            fetch('fetchAppointments.php')
                .then(response => response.json())
                .then(appointments => displayApprovedAppointments(appointments))
                .catch(error => console.error('Error:', error));
        };

        function displayApprovedAppointments(appointments) {
            const tableBody = document.querySelector('#adminAppointmentsTable tbody');
            tableBody.innerHTML = ''; // Clear existing rows

            for (const appointment of appointments) {
                if (appointment.status === 'approved') {
                    const row = tableBody.insertRow();

                    const keys = ['destination', 'guestname', 'arrivaldate', 'leavingdate', 'contact'];
                    keys.forEach(key => {
                        const cell = row.insertCell();
                        cell.textContent = appointment[key];
                    });
                }
            }
        }
    </script>

</body>
</html>

<?php
function fetchAppointments() {
    // Simulate fetching appointments from a database or external source
    // Replace this with your actual data retrieval logic
    $appointments = [
        [
            'doctor' => 'Dr. Smith',
            'patientName' => 'John Doe',
            'date' => '2024-02-16',
            'time' => '10:00 AM',
            'status' => 'approved'
        ],
        [
            'doctor' => 'Dr. Johnson',
            'patientName' => 'Jane Smith',
            'date' => '2024-02-17',
            'time' => '11:00 AM',
            'status' => 'pending'
        ],
        [
            'doctor' => 'Dr. Brown',
            'patientName' => 'Alice Johnson',
            'date' => '2024-02-18',
            'time' => '12:00 PM',
            'status' => 'approved'
        ]
    ];

    return $appointments;
}
?>
