@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Properties List</h1>

    <!-- زر إضافة عقار جديد -->
    <a href="{{ route('properties.create') }}" class="btn btn-primary mb-3">Add New Property</a>

    <!-- عرض قائمة العقارات -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                   
                    <th>Title</th>
                    <th>Location</th>
                    <th>Type</th>
                  
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>{{ $property->title }}</td>
                        <td>{{ optional($property->location)->name ?? 'N/A' }}</td>
                        <td>{{ optional($property->property_type)->name ?? 'N/A' }}</td>

                      
                       <td class="d-flex justify-content-start align-items-center gap-3">  <!-- زيادة المسافة هنا -->
                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('properties.property-images.create', $property->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Add Image
                        </a>
                        <a href="{{ route('comments.index', $property->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Show Comments
                        </a>
                      
                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                    
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- رابط التنقل بين الصفحات -->
    {{ $properties->links() }}
</div>
@endsection
