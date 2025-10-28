   <ul class="nav">
          <li class="nav-item">
            <div class="d-flex sidebar-profile">
              <div class="sidebar-profile-image">
                <img src="{{ asset('user/images/faces/face29.png') }}" alt="image">
                <span class="sidebar-status-indicator"></span>
              </div>
              <div class="sidebar-profile-name">
                <p class="sidebar-name">
                  Kenneth Osborne
                </p>
                <p class="sidebar-designation">
                  Welcome
                </p>
              </div>
            </div>
            <div class="nav-search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                <div class="input-group-append">
                  <span class="input-group-text" id="search">
                    <i class="typcn typcn-zoom"></i>
                  </span>
                </div>
              </div>
            </div>
            <p class="sidebar-menu-title">Dash menu</p>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="typcn typcn-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('manajer.categories.index') }}">
              <i class="typcn typcn-th-large menu-icon"></i>
              <span class="menu-title" >Kategori Transaksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#transaksi" aria-expanded="false" aria-controls="transaksi">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Transaksi</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transaksi">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/income"> Income </a></li>
                <li class="nav-item"> <a class="nav-link" href="#"> Expense </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-file-earmark-pdf-fill menu-icon"></i>
              <span class="menu-title">Laporan Keuangan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-person-circle menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
        </ul>
