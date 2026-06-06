import os
import re
import shutil

BASE_URL = "/LeaveManagement/"

file_moves = {
    # user
    'UserMas.php': 'pages/user/UserMas.php',
    'UserMaster.php': 'pages/user/UserMaster.php',
    'AdminEntry.php': 'pages/user/AdminEntry.php',
    'ChangePassword.php': 'pages/user/ChangePassword.php',
    # department
    'DepartmentMas.php': 'pages/department/DepartmentMas.php',
    'DepartmentMaster.php': 'pages/department/DepartmentMaster.php',
    # faculty
    'FacultyInfo.php': 'pages/faculty/FacultyInfo.php',
    'FacultyInfo1.php': 'pages/faculty/FacultyInfo1.php',
    'FacultyInfo2.php': 'pages/faculty/FacultyInfo2.php',
    # leave
    'LeaveOfType.php': 'pages/leave/LeaveOfType.php',
    'LeaveOfType1.php': 'pages/leave/LeaveOfType1.php',
    'FacultyLeaveMas.php': 'pages/leave/FacultyLeaveMas.php',
    'FacultyLeaveMaster.php': 'pages/leave/FacultyLeaveMaster.php',
    'FacultyLeaveMaster1.php': 'pages/leave/FacultyLeaveMaster1.php',
    'FacultyLeaveAllocat.php': 'pages/leave/FacultyLeaveAllocat.php',
    'FacultyLeaveAllocat1.php': 'pages/leave/FacultyLeaveAllocat1.php',
    'FacultyLeaveAllocation.php': 'pages/leave/FacultyLeaveAllocation.php',
    'FacultyLeaveAllocation1.php': 'pages/leave/FacultyLeaveAllocation1.php',
    # year
    'YearMas.php': 'pages/year/YearMas.php',
    'YearMaster.php': 'pages/year/YearMaster.php',
    # student
    'StudRegister.php': 'pages/student/StudRegister.php',
    # reports
    'Report.php': 'pages/reports/Report.php',
    'Report1.php': 'pages/reports/Report1.php',
    'datewise.php': 'pages/reports/datewise.php',
    'monthwise.php': 'pages/reports/monthwise.php',
    'yearwise.php': 'pages/reports/yearwise.php',
    # ajax
    'ajax.php': 'ajax/ajax.php',
    'ajax-delete.php': 'ajax/ajax-delete.php',
    'ajax-load.php': 'ajax/ajax-load.php',
    'ajax-update-form.php': 'ajax/ajax-update-form.php',
    'load-cs.php': 'ajax/load-cs.php',
    'load-update-form.php': 'ajax/load-update-form.php',
    'Loadtable.php': 'ajax/Loadtable.php',
    'Loadtable2.php': 'ajax/Loadtable2.php',
    'UserMas-load-data.php': 'ajax/UserMas-load-data.php',
    'UserMaster1.php': 'ajax/UserMaster1.php',
    'UserDelMas.php': 'ajax/UserDelMas.php',
    'UserdataUpdate.php': 'ajax/UserdataUpdate.php',
    'FacultyInfoDel.php': 'ajax/FacultyInfoDel.php',
    'DepartmentMasterDel.php': 'ajax/DepartmentMasterDel.php',
    'DeptDelMas.php': 'ajax/DeptDelMas.php',
    'DelLeaveOfType.php': 'ajax/DelLeaveOfType.php',
    'DelFacultyLeaveAllocat.php': 'ajax/DelFacultyLeaveAllocat.php',
    'FacultyLeaveDelMaster.php': 'ajax/FacultyLeaveDelMaster.php',
    # tools
    'DataBaseBackup.php': 'tools/DataBaseBackup.php',
    'Mysqldump.php': 'tools/Mysqldump.php',
}

# Add BASE_URL to connect.php
connect_path = 'includes/connect.php'
with open(connect_path, 'r', encoding='utf-8') as f:
    content = f.read()
if "define('BASE_URL" not in content:
    content = content.replace("<?php", "<?php\nif (!defined('BASE_URL')) {\n    define('BASE_URL', '/LeaveManagement/');\n}")
    with open(connect_path, 'w', encoding='utf-8') as f:
        f.write(content)

# Update includes (header, footer, navbar, scripts)
for inc in ['includes/header.php', 'includes/footer.php', 'includes/navbar.php', 'includes/scripts.php', 'index.php', 'Log.php']:
    if not os.path.exists(inc): continue
    with open(inc, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Update CSS/JS/IMG links
    content = re.sub(r'(href|src)="((?:css|js|vendor|img)/.*?)"', r'\1="<?= BASE_URL ?>\2"', content)
    
    # Update explicit page links
    for old_file, new_path in file_moves.items():
        content = re.sub(rf'(href|url|action)="{old_file}"', rf'\1="<?= BASE_URL ?>{new_path}"', content)
        content = re.sub(rf"(href|url|action)='{old_file}'", rf"\1='<?= BASE_URL ?>{new_path}'", content)
    
    # Update specific links in index.php
    if inc == 'index.php':
        content = content.replace('href="DataBaseBackup.php"', 'href="<?= BASE_URL ?>tools/DataBaseBackup.php"')
        
    with open(inc, 'w', encoding='utf-8') as f:
        f.write(content)

# Process all files being moved
for old_file, new_path in file_moves.items():
    if not os.path.exists(old_file):
        print(f"File {old_file} not found, skipping.")
        continue
        
    with open(old_file, 'r', encoding='utf-8') as f:
        content = f.read()
        
    # Determine depth
    depth = new_path.count('/')
    if depth == 2:
        include_prefix = '../../'
    elif depth == 1:
        include_prefix = '../'
    else:
        include_prefix = ''
        
    # Update include paths
    content = content.replace("include('includes/", f"include('{include_prefix}includes/")
    content = content.replace('include("includes/', f'include("{include_prefix}includes/')
    content = content.replace("include('include/", f"include('{include_prefix}includes/") # fix typos
    
    # Also fix header locations for redirects
    content = re.sub(r'header\("location:(.*?)\.php"\)', r'header("location:<?= BASE_URL ?>\1.php")', content)
    
    # Update AJAX URLs and hrefs inside the moved files
    for old_target, new_target in file_moves.items():
        # AJAX and hrefs
        content = re.sub(rf'(href|url|action)="{old_target}"', rf'\1="<?= BASE_URL ?>{new_target}"', content)
        content = re.sub(rf"(href|url|action)='{old_target}'", rf"\1='<?= BASE_URL ?>{new_target}'", content)
        
    # Also fix explicit base links like index.php
    content = re.sub(r'(href|url|action)="index.php"', r'\1="<?= BASE_URL ?>index.php"', content)
    content = re.sub(r"(href|url|action)='index.php'", r"\1='<?= BASE_URL ?>index.php'", content)

    # Some files use require
    content = content.replace("require('includes/", f"require('{include_prefix}includes/")
    
    # Write to new path
    os.makedirs(os.path.dirname(new_path), exist_ok=True)
    with open(new_path, 'w', encoding='utf-8') as f:
        f.write(content)
        
    # Delete old file
    os.remove(old_file)

# Delete stale files
stale_files = ['YearMasold.php', 'Login2.php', 'tempCodeRunnerFile.python', 'gulpfile.js']
for stale in stale_files:
    if os.path.exists(stale):
        os.remove(stale)

print("Restructure complete!")
