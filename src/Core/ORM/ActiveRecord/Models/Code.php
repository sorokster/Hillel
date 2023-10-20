<?php declare(strict_types=1);

namespace Hillel\Project\Core\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Code extends Model
{
    protected $table = 'codes';
    public $timestamps = false;
    protected $fillable = ['url_id', 'code'];

    /** @return BelongsTo */
    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }

    public static function fromState(int $urlId, string $code): Code
    {
        return new Code([
            'url_id' => $urlId,
            'code' => $code,
        ]);
    }
}
