<?php declare(strict_types=1);

namespace Hillel\Project\Core\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Url extends Model
{
    protected $table = 'urls';
    public $timestamps = false;
    protected $fillable = ['url'];

    protected int $id;
    protected string $url;

    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

    /** @param int $id */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /** @return string */
    public function getUrl(): string
    {
        return $this->url;
    }

    /** @param string $url */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /** @return HasOne */
    public function code(): HasOne
    {
        return $this->hasOne(Code::class);
    }

    /**
     * @param string $url
     * @return Url
     */
    public static function fromState(string $url): Url
    {
        return new Url(['url' => $url]);
    }
}
