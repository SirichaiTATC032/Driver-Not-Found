<?php
    require_once 'config.php';

    $team = "Driver Not Found";
    $topic = "ระบบคลังโปรแกรมและไดรเวอร์ออนไลน์สำหรับการเรียนการสอน";
    $problem = "นักศึกษาและครูต้องเสียเวลาตามหาโปรแกรมและไดรเวอร์จากหลายเว็บไซต์ เสี่ยงได้เวอร์ชันไม่ตรงหรือติดไวรัส";
    $members = [
        "นายสิริชัย บุญธรรม (Developer A)", 
        "นายพีรพัฒน์ คล้ายศร (Developer B)"
    ];

    $labName = "ห้องปฏิบัติการเทคโนโลยีคอมพิวเตอร์ Computer Technology Laboratory";
    $totalPrograms = 120;
    $totalDrivers = 45;
    $totalDownloads = 1500;
    $isSystemOnline = true;
    $usedStoragePercent = 80;

    $totalItems = $totalPrograms + $totalDrivers;

    $needStorageAlert = $usedStoragePercent >= STORAGE_ALERT_PERCENT;
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $topic; ?></title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #0b0f17;
            color: #f8fafc;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #151c28;
            padding: 28px 20px;
            border-right: 1px solid #222d3d;
            flex-shrink: 0;
        }
        .brand-title {
            font-size: 20px;
            font-weight: 700;
            color: #38bdf8;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.5px;
        }
        
        .menu-section-title {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 12px;
            margin-top: 24px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .menu-section-title:first-of-type {
            margin-top: 0;
        }

        .menu-list {
            list-style: none;
            margin-bottom: 10px;
        }
        .menu-item {
            padding: 10px 14px;
            margin-bottom: 4px;
            border-radius: 8px;
            color: #94a3b8;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .menu-item:hover {
            background-color: #1e293b;
            color: #f8fafc;
        }
        .menu-item.active {
            background-color: #0284c7;
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        .main-content {
            flex: 1;
            padding: 32px;
            background-color: #0b0f17;
        }
        .top-header {
            margin-bottom: 28px;
        }
        .top-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #f8fafc;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .top-header p {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 6px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }
        .card {
            background-color: #151c28;
            padding: 22px;
            border-radius: 12px;
            border: 1px solid #222d3d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            border-color: #334155;
        }
        .card p {
            color: #94a3b8;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .card h2 {
            font-size: 30px;
            font-weight: 700;
            color: #ffffff;
            margin-top: 10px;
        }

        .progress-bg {
            background-color: #222d3d;
            height: 8px;
            border-radius: 4px;
            margin-top: 14px;
            overflow: hidden;
        }
        .progress-fill {
            background-color: #38bdf8;
            height: 100%;
            border-radius: 4px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }
        .box {
            background-color: #151c28;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #222d3d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .box h3 {
            font-size: 16px;
            font-weight: 600;
            color: #f8fafc;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid #222d3d;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* กล่องแจ้งเตือนโทนสีส้ม/เข้ม */
        .box-warning {
            background-color: #24160e;
            border: 1px solid #6c2710;
        }
        .box-warning h3 {
            color: #fbbf24;
            border-bottom-color: #3f190a;
        }

        .list-item {
            padding: 10px 0;
            border-bottom: 1px solid #222d3d;
            font-size: 14px;
            color: #cbd5e1;
        }
        .box-warning .list-item {
            border-bottom-color: #3f190a;
            color: #fde68a;
        }
        .list-item:last-child {
            border-bottom: none;
        }

        .team-info {
            margin-top: 12px;
            font-size: 14px;
            color: #94a3b8;
            line-height: 1.6;
        }
        .team-info ul {
            margin-left: 20px;
            margin-top: 6px;
            color: #cbd5e1;
        }

        .footer-link {
            margin-top: 28px;
            font-size: 14px;
        }
        .footer-link a {
            color: #38bdf8;
            text-decoration: none;
        }
        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand-title">
            <span>🔍</span> Driver Not Found
        </div>

        <div class="menu-section-title">📌 เมนูหลัก</div>
        <ul class="menu-list">
            <li class="menu-item active"><span>📊</span> หน้าหลัก</li>
            <li class="menu-item"><span>💾</span> คลังโปรแกรม</li>
            <li class="menu-item"><span>⚙️</span> ไดรเวอร์</li>
            <li class="menu-item"><span>👤</span> บัญชี</li>
        </ul>

        <div class="menu-section-title">🛠️ ระบบ</div>
        <ul class="menu-list">
            <li class="menu-item"><span>👥</span> ทีมที่พัฒนา</li>
        </ul>
    </div>

    <div class="main-content">

        <div class="top-header">
            <h1>🖥️ <?php echo APP_NAME; ?></h1>
            <p><?php echo $labName; ?> · ทีม: <?php echo $team; ?> · วันที่ <?php echo date('d/m/Y'); ?></p>
        </div>

        <!-- การ์ดตัวเลข 4 กล่อง -->
        <div class="card-grid">
            <div class="card">
                <p><span>📦</span> โปรแกรมทั้งหมด</p>
                <h2><?php echo number_format($totalPrograms); ?></h2>
            </div>

            <div class="card">
                <p><span>⚙️</span> ไดรเวอร์ทั้งหมด</p>
                <h2><?php echo number_format($totalDrivers); ?></h2>
            </div>

            <div class="card">
                <p><span>💻</span> ซอฟต์แวร์ทั้งหมด</p>
                <h2><?php echo number_format($totalItems); ?></h2>
            </div>

            <div class="card">
                <p><span>☁️</span> พื้นที่จัดเก็บ</p>
                <h2><?php echo $usedStoragePercent; ?>%</h2>
                <div class="progress-bg">
                    <div class="progress-fill" style="width: <?php echo $usedStoragePercent; ?>%;"></div>
                </div>
            </div>
        </div>

        <div class="content-grid">

            <div class="box">
                <h3><span>🔄</span> อัปเดตโปรแกรมล่าสุด</h3>
                <div class="list-item">• Update: Intel Graphics Driver v31.0.101.4502 (2026-10-26)</div>
                <div class="list-item">• New: WinRAR 6.24 (2026-10-25)</div>
                <div class="list-item">• Fix: Adobe Reader update (2026-10-24)</div>
                <div class="list-item">• New: XAMPP for Windows (2026-10-20)</div>

                <h3 style="margin-top: 24px;"><span>📥</span> ประวัติการดาวน์โหลด</h3>
                <div class="list-item">• ยอดการดาวน์โหลดรวมทั้งระบบ: <b><?php echo number_format($totalDownloads); ?> ครั้ง</b></div>
                <div class="list-item">• ซอฟต์แวร์ยอดนิยม: XAMPP for Windows (PHP 8.2)</div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 22px;">
                
                <div class="box box-warning">
                    <h3><span>⚠️</span> ข้อความแจ้งเตือน</h3>
                    <?php if ($needStorageAlert): ?>
                        <div class="list-item">• พื้นที่จัดเก็บไฟล์ใช้ไปแล้ว <?php echo $usedStoragePercent; ?>% (เกินเกณฑ์กำหนด)</div>
                    <?php endif; ?>
                    <div class="list-item">• ระบบสำรองข้อมูลอัตโนมัติจะทำงานในอีก 2 วัน</div>
                    <div class="list-item">• สถานะเซิร์ฟเวอร์: <?php echo $isSystemOnline ? 'ออนไลน์ (ปกติ)' : 'ออฟไลน์'; ?></div>
                </div>

                <div class="box">
                    <h3><span>👨‍💻</span> ทีมที่พัฒนา</h3>
                    <div class="team-info">
                        <p><b>ปัญหาที่แก้:</b> <?php echo $problem; ?></p>
                        <p style="margin-top: 8px;"><b>สมาชิกในทีม:</b></p>
                        <ul>
                            <?php foreach ($members as $m): ?>
                                <li><?php echo $m; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

        <div class="footer-link">
            <a href="about.php">← เกี่ยวกับโครงงาน (About)</a>
        </div>

    </div>

</body>
</html>