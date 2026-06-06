<?php
include('../../includes/auth_check.php');

if ($_SESSION['UserType'] !== 'Admin') {
    echo "<script>alert('Unauthorized Access'); window.location.href='<?= BASE_URL ?>index.php';</script>";
    exit;
}

include('../../includes/header.php');
include('../../includes/navbar.php');
include('../../includes/connect.php');

$message = "";
if(isset($_POST['btnSubmit'])) {
    $UserName = trim($_POST['UserName']);
    $Password = $_POST['Password'];
    $CPassword = $_POST['CPassword'];
    
    if($Password === $CPassword) {
        // Check if username exists
        $stmt_check = $conn->prepare("SELECT UserMasterID FROM usermaster WHERE UserName=?");
        $stmt_check->bind_param("s", $UserName);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if($stmt_check->num_rows > 0) {
            $message = "<div class='alert alert-warning' style='border-radius: 12px; font-family: \"Inter\", sans-serif;'>Username already exists!</div>";
        } else {
            $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);
            $UserType = 'Admin';
            $DeptID = '444'; // default for Admin
            
            $stmt = $conn->prepare("INSERT INTO usermaster (UserName, Password, UserType, DeptID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $UserName, $HashedPassword, $UserType, $DeptID);
            
            if($stmt->execute()) {
                $message = "<div class='alert alert-success' style='border-radius: 12px; font-family: \"Inter\", sans-serif;'>Administrator created successfully!</div>";
            } else {
                $message = "<div class='alert alert-danger' style='border-radius: 12px; font-family: \"Inter\", sans-serif;'>Failed to create Administrator.</div>";
            }
            $stmt->close();
        }
        $stmt_check->close();
    } else {
        $message = "<div class='alert alert-danger' style='border-radius: 12px; font-family: \"Inter\", sans-serif;'>Passwords do not match!</div>";
    }
}
?>

<style>
/* Glassmorphism Design */
.glass-container {
    background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    padding: 20px;
    background-image: url('data:image/svg+xml,%3Csvg width=\"100%25\" height=\"100%25\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cdefs%3E%3ClinearGradient id=\"a\" x1=\"0\" x2=\"100%25\" y1=\"0\" y2=\"100%25\"%3E%3Cstop offset=\"0\" stop-color=\"%23eef2f3\"/%3E%3Cstop offset=\"1\" stop-color=\"%238e9eab\"/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width=\"100%25\" height=\"100%25\" fill=\"url(%23a)\"/%3E%3C/svg%3E');
    background-size: cover;
    position: relative;
    overflow: hidden;
}

.glass-container::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(78, 115, 223, 0.1) 0%, transparent 60%);
    z-index: 0;
}

.glass-card {
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: 24px;
    padding: 45px 40px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 10px 40px -10px rgba(31, 38, 135, 0.15);
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    z-index: 1;
}

.glass-card:hover {
    transform: translateY(-8px);
}

.glass-title {
    font-family: 'Inter', sans-serif;
    font-weight: 800;
    color: #1a2035;
    margin-bottom: 35px;
    text-align: center;
    letter-spacing: -0.5px;
    font-size: 1.8rem;
}

.form-floating-custom {
    position: relative;
    margin-bottom: 25px;
}

.glass-input {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid transparent;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 14px;
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    color: #2c3e50;
    transition: all 0.3s ease;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
}

.glass-input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.95);
    border-color: #4e73df;
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.15);
}

.glass-label {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    font-family: 'Inter', sans-serif;
    color: #6c757d;
    transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    pointer-events: none;
    font-weight: 500;
}

.glass-input:focus ~ .glass-label,
.glass-input:not(:placeholder-shown) ~ .glass-label {
    top: -12px;
    left: 15px;
    font-size: 13px;
    background: linear-gradient(180deg, transparent 50%, white 50%);
    padding: 0 8px;
    border-radius: 6px;
    color: #4e73df;
    font-weight: 700;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}

.glass-btn {
    width: 100%;
    padding: 16px;
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    color: white;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(78, 115, 223, 0.3);
    margin-top: 10px;
}

.glass-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(78, 115, 223, 0.4);
    background: linear-gradient(135deg, #5a7fee 0%, #2953c9 100%);
}

.glass-btn:active {
    transform: translateY(1px);
    box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
}

.glass-icon {
    display: flex;
    justify-content: center;
    margin-bottom: 25px;
}

.glass-icon svg {
    color: #4e73df;
    filter: drop-shadow(0 4px 8px rgba(78, 115, 223, 0.4));
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-6px); }
    100% { transform: translateY(0px); }
}

</style>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="container-fluid">
    <div class="glass-container">
        <div class="glass-card">
            <div class="glass-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5z"/>
                </svg>
            </div>
            <h2 class="glass-title">Create Admin</h2>
            
            <?php echo $message; ?>
            
            <form method="post" action="" autocomplete="off">
                <div class="form-floating-custom">
                    <input type="text" id="UserName" name="UserName" class="glass-input" placeholder=" " required>
                    <label for="UserName" class="glass-label">Username</label>
                </div>
                
                <div class="form-floating-custom">
                    <input type="password" id="Password" name="Password" class="glass-input" placeholder=" " required>
                    <label for="Password" class="glass-label">Password</label>
                </div>
                
                <div class="form-floating-custom">
                    <input type="password" id="CPassword" name="CPassword" class="glass-input" placeholder=" " required>
                    <label for="CPassword" class="glass-label">Confirm Password</label>
                </div>
                
                <button type="submit" name="btnSubmit" class="glass-btn">Register Administrator</button>
            </form>
        </div>
    </div>
</div>

<?php
include('../../includes/scripts.php');
include('../../includes/footer.php');
?>
