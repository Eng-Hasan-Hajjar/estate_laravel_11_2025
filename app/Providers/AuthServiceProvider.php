namespace App\Providers;

use App\Models\Property;
use App\Policies\PropertyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Property::class => PropertyPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}