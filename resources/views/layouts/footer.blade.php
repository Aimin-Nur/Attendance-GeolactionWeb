 <!-- App Bottom Menu -->
 <div class="appBottomMenu">
        <a href="#" class="item {{ request()->is('dashboard') ? 'active' : '' }} ">
            <div class="col">
                <ion-icon name="home-outline" role="img" class="md hydrated"
                    aria-label="file tray full outline"></ion-icon>
                <strong>Dashboard</strong>
            </div>
        </a>
        <a href="#" class="item {{ request()->is('calendar') ? 'active' : '' }} ">
            <div class="col">
                <ion-icon name="calendar-outline" role="img" class="md hydrated"
                    aria-label="calendar outline"></ion-icon>
                <strong>Calendar</strong>
            </div>
        </a>
        <a href="/absen/absensi" class="item">
            <div class="col">
                <div class="action-button large">
                    <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
                </div>
            </div>
        </a>
        <a href="#" class="item">
            <div class="col">
                <ion-icon name="document-text-outline" role="img" class="md hydrated"
                    aria-label="document text outline"></ion-icon>
                <strong>Docs</strong>
            </div>
        </a>
        <a href="javascript:;" class="item">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->
