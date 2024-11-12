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

          <!-- Total Comments -->
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-comments"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Comments</span>
                      <span class="info-box-number">{{ $totalComments }}</span>
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
      </div>
  </div>
</section>
