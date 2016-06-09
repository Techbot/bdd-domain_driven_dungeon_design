<?php 
namespace DeckOfCards\Domain;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
final class ArmyId
{
    /**
     * @var Uuid
     */
    protected $value;
    /**
     * @param UuidInterface $value
     */
    private function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }
    /**
     * @return static
     */
    public static function generate()
    {
        return new static(Uuid::uuid4());
    }
    /**
     * @param string $value
     * @return static
     */
    public static function fromString($value)
    {
        return new static(Uuid::fromString($value));
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value->toString();
    }
    /**
     * @param ArmyId $id
     * @return bool
     */
    public function matches(ArmyId $id)
    {
        return (string) $id == (string) $this;
    }
}