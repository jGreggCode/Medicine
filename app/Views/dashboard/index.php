<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background-color: #2d2d2d;
            padding: 2rem;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        .user-info {
            text-align: center;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background-color: #dc3545;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .nav-links {
            list-style: none;
        }

        .nav-links li {
            margin-bottom: 1rem;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #dc3545;
        }

        .nav-links i {
            margin-right: 10px;
            width: 20px;
        }

        .welcome-card {
            background-color: #2d2d2d;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background-color: #2d2d2d;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
        }

        .stat-card i {
            font-size: 2rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .logout-btn {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            right: 2rem;
            padding: 0.8rem;
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        /* Add table styles */
        .table-container {
            background-color: #2d2d2d;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .search-bar {
            flex: 1;
            margin-right: 1rem;
        }

        .search-input {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background-color: #3d3d3d;
            color: white;
        }

        .btn-add {
            padding: 0.8rem 1.5rem;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #3d3d3d;
        }

        th {
            background-color: #3d3d3d;
            color: white;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit,
        .btn-delete {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
        }

        .modal-content {
            background-color: #2d2d2d;
            margin: 2rem auto;
            /* Changed from 5% to 2rem */
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            position: relative;
            /* Add this */
            max-height: 90vh;
            /* Add this */
            overflow-y: auto;
            /* Add this */
        }

        /* Add these new styles for better form layout */
        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .btn-container {
            position: sticky;
            /* Add this */
            bottom: 0;
            /* Add this */
            background-color: #2d2d2d;
            /* Add this */
            padding-top: 1rem;
            /* Add this */
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
        }

        /* Style the buttons in the modal */
        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .btn-primary {
            background-color: #dc3545;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        /* Add custom scrollbar styles for better appearance */
        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #dc3545;
            border-radius: 4px;
        }

        .modal-content::-webkit-scrollbar-thumb:hover {
            background: #c82333;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background-color: #3d3d3d;
            color: white;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 1rem 2rem;
            border-radius: 5px;
            color: white;
            display: none;
            z-index: 1001;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-row .form-group {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h3><?= session()->get('name') ?></h3>
            <p><?= session()->get('email') ?></p>
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Profile</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
        <a href="/auth/logout" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="content">
        <div class="welcome-card">
            <h1>Welcome back, <?= session()->get('name') ?>!</h1>
            <p>Here's the medicine system.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-hospital-user"></i>
                <h3>Active Patients</h3>
                <p><?= $activePatients ?></p>
            </div>
            <div class="stat-card">
                <i class="fas fa-notes-medical"></i>
                <h3>Weekly Cases</h3>
                <p><?= $weeklyCases ?></p>
            </div>
            <div class="stat-card">
                <i class="fas fa-file-medical"></i>
                <h3>Total Records</h3>
                <p><?= $totalRecords ?></p>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div class="search-bar">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search consultations...">
                </div>
                <button class="btn-add" onclick="openAddModal()">New Consultation</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Visit Date</th>
                        <th>Patient Name</th>
                        <th>Age/Gender</th>
                        <th>Symptoms</th>
                        <th>Diagnosis</th>
                        <th>Prescribed Medicines</th>
                        <th>Next Visit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="consultationTable">
                    <?php foreach ($consultations as $consultation): ?>
                        <tr>
                            <td><?= date('Y-m-d', strtotime($consultation['visit_date'])) ?></td>
                            <td><?= $consultation['patient_name'] ?></td>
                            <td><?= $consultation['age'] ?>/<?= $consultation['gender'] ?></td>
                            <td><?= $consultation['symptoms'] ?></td>
                            <td><?= $consultation['diagnosis'] ?></td>
                            <td><?= $consultation['prescribed_medicines'] ?></td>
                            <td><?= $consultation['next_visit'] ? date('Y-m-d', strtotime($consultation['next_visit'])) : 'N/A' ?></td>
                            <td class="actions">
                                <button class="btn-edit" onclick="editConsultation(<?= $consultation['id'] ?>)">Edit</button>
                                <button class="btn-delete" onclick="deleteConsultation(<?= $consultation['id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="consultationModal" class="modal">
        <div class="modal-content">
            <h2 id="modalTitle">New Consultation</h2>
            <form id="consultationForm">
                <input type="hidden" id="consultationId">
                <div class="form-group">
                    <label for="patient_name">Patient Name</label>
                    <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number">
                </div>
                <div class="form-group">
                    <label for="symptoms">Symptoms</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" required></textarea>
                </div>
                <div class="form-group">
                    <label for="diagnosis">Diagnosis</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis" required></textarea>
                </div>
                <div class="form-group">
                    <label for="treatment">Treatment Plan</label>
                    <textarea class="form-control" id="treatment" name="treatment" required></textarea>
                </div>
                <div class="form-group">
                    <label for="prescribed_medicines">Prescribed Medicines</label>
                    <textarea class="form-control" id="prescribed_medicines" name="prescribed_medicines" required></textarea>
                </div>
                <div class="form-group">
                    <label for="notes">Additional Notes</label>
                    <textarea class="form-control" id="notes" name="notes"></textarea>
                </div>
                <div class="form-group">
                    <label for="next_visit">Next Visit Date</label>
                    <input type="date" class="form-control" id="next_visit" name="next_visit">
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast" class="toast"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('#consultationTable tr').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(searchTerm) > -1);
            });
        });

        function openAddModal() {
            $('#modalTitle').text('New Consultation');
            $('#consultationId').val('');
            $('#consultationForm')[0].reset();
            $('#consultationModal').show();
        }

        function closeModal() {
            $('#consultationModal').hide();
        }

        function editConsultation(id) {
            $.get(`/consultation/get/${id}`, function(consultation) {
                $('#modalTitle').text('Edit Consultation');
                $('#consultationId').val(consultation.id);
                $('#patient_name').val(consultation.patient_name);
                $('#age').val(consultation.age);
                $('#gender').val(consultation.gender);
                $('#contact_number').val(consultation.contact_number);
                $('#symptoms').val(consultation.symptoms);
                $('#diagnosis').val(consultation.diagnosis);
                $('#treatment').val(consultation.treatment);
                $('#prescribed_medicines').val(consultation.prescribed_medicines);
                $('#notes').val(consultation.notes);
                $('#next_visit').val(consultation.next_visit ? consultation.next_visit.split(' ')[0] : '');
                $('#consultationModal').show();
            });
        }

        function deleteConsultation(id) {
            if (confirm('Are you sure you want to delete this consultation record?')) {
                $.post(`/consultation/delete/${id}`, function(response) {
                    if (response.status === 'success') {
                        showToast(response.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showToast(response.message, 'error');
                    }
                });
            }
        }

        $('#consultationForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#consultationId').val();
            const url = id ? `/consultation/update/${id}` : '/consultation/store';

            $.ajax({
                url: url,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        showToast(response.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showToast(response.message, 'error');
                    }
                }
            });
        });

        function showToast(message, type) {
            const toast = $('#toast');
            toast.text(message)
                .css('background-color', type === 'success' ? '#28a745' : '#dc3545')
                .fadeIn();

            setTimeout(() => toast.fadeOut(), 3000);
        }

        // Close modal when clicking outside
        $(window).click(function(e) {
            if ($(e.target).is('.modal')) {
                closeModal();
            }
        });
    </script>
</body>

</html>