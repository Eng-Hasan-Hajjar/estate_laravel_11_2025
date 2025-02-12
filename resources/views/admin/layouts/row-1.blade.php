<section class="content">
  <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
          <!-- Total Properties -->
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Properties</span>
                      <span class="info-box-number">{{ $totalProperties }}</span>
                  </div>
              </div>
          </div>

          <!-- Total Reviews -->
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-star"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Reviews</span>
                      <span class="info-box-number">{{ $totalReviews }}</span>
                  </div>
              </div>
          </div>


          <!-- Total Images -->
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-image"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Images</span>
                      <span class="info-box-number">{{ $totalImages }}</span>
                  </div>
              </div>
          </div>

          <!-- Total Users -->
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Users</span>
                      <span class="info-box-number">{{ $totalUsers }}</span>
                  </div>
              </div>
          </div>

        <!-- Total Locations -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Locations</span>
                    <span class="info-box-number">{{ $totalLocations }}</span>
                </div>
            </div>
        </div>

            <!-- Total Regions -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-globe"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Regions</span>
                <span class="info-box-number">{{ $totalRegions }}</span>
            </div>
        </div>
    </div>

    <!-- Total Property Types -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-home"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Property Types</span>
                <span class="info-box-number">{{ $totalPropertyTypes }}</span>
            </div>
        </div>
    </div>

    <!-- Available Properties -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Available Properties</span>
                <span class="info-box-number">{{ $availableProperties }}</span>
            </div>
        </div>
    </div>



      </div>
  </div>
</section>
