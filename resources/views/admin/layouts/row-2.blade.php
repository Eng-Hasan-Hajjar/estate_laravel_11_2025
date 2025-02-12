<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">Properties by Status</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <div class="btn-group">
            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-wrench"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
              <a href="#" class="dropdown-item">Action</a>
              <a href="#" class="dropdown-item">Another action</a>
              <a href="#" class="dropdown-item">Something else here</a>
              <a class="dropdown-divider"></a>
              <a href="#" class="dropdown-item">Separated link</a>
            </div>
          </div>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <div class="card">
              
                  <div class="card-body">
                      <canvas id="propertiesByStatusChart" style="height: 250px;"></canvas>
                  </div>
              </div>
          </div>
          <!-- Latest Properties -->
          <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Latest Properties</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($latestProperties as $property)
                            <li class="list-group-item">
                                <a href="{{ route('properties.edit', $property->id) }}">{{ $property->title }}</a>
                                <span class="badge bg-primary float-end">{{ $property->status }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
          </div>
          <!-- Latest Comments -->
          <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Latest Comments</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($latestComments as $comment)
                            <li class="list-group-item">
                                <strong>{{ $comment->user->name }}</strong> on
                                <a href="{{ route('properties.edit', $comment->property->id) }}">{{ $comment->property->title }}</a>
                                <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- ./card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('propertiesByStatusChart').getContext('2d');
    const propertiesByStatusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Available', 'Sold', 'Rented'],
            datasets: [{
                data: [{{ $availableProperties }}, {{ $soldProperties }}, {{ $rentedProperties }}],
                backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>














  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Monthly Recap Report</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-wrench"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a href="#" class="dropdown-item">Action</a>
                <a href="#" class="dropdown-item">Another action</a>
                <a href="#" class="dropdown-item">Something else here</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">Separated link</a>
              </div>
            </div>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <!-- عرض البيانات المجمعة -->
            <div class="col-md-3 col-6">
              <div class="description-block border-right">
                <h5 class="description-header">{{ $totalProperties }}</h5>
                <span class="description-text">TOTAL PROPERTIES</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-6">
              <div class="description-block border-right">
                <h5 class="description-header">{{ $totalUsers }}</h5>
                <span class="description-text">TOTAL USERS</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-6">
              <div class="description-block border-right">
                <h5 class="description-header">{{ $totalImages }}</h5>
                <span class="description-text">TOTAL IMAGES</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-6">
              <div class="description-block">
                <h5 class="description-header">{{ $totalVisits }}</h5>
                <span class="description-text">TOTAL VISITS</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-3 col-6">
              <div class="description-block border-right">
                <h5 class="description-header"></h5>
                <span class="description-text">COMPLETED TRANSACTIONS</span>
              </div>
              <!-- /.description-block -->
            </div>
            <div class="col-sm-3 col-6">
              <div class="description-block border-right">
                <h5 class="description-header">{{ $monthlyProperties }}</h5>
                <span class="description-text">PROPERTIES THIS MONTH</span>
              </div>
              <!-- /.description-block -->
            </div>
            <div class="col-sm-3 col-6">
              <div class="description-block border-right">
                <h5 class="description-header">{{ $totalReviews }}</h5>
                <span class="description-text">TOTAL REVIEWS</span>
              </div>
              <!-- /.description-block -->
            </div>
            <div class="col-sm-3 col-6">
              <div class="description-block">
                <h5 class="description-header">{{ $totalComments }}</h5>
                <span class="description-text">TOTAL COMMENTS</span>
              </div>
              <!-- /.description-block -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
