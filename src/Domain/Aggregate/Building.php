<?php

declare(strict_types=1);

namespace Building\Domain\Aggregate;

use Building\Domain\DomainEvent\NewBuildingWasRegistered;
use Prooph\EventSourcing\AggregateRoot;
use Rhumsaa\Uuid\Uuid;
use Building\Domain\DomainEvent\UserHasCheckedIn;
use Building\Domain\DomainEvent\UserHasCheckedOut;

final class Building extends AggregateRoot
{
    /**
     * @var Uuid
     */
    private $uuid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $checkedInUsers;

    public static function new(string $name) : self
    {
        $self = new self();

        $self->recordThat(NewBuildingWasRegistered::occur(
            (string) Uuid::uuid4(),
            [
                'name' => $name
            ]
        ));

        return $self;
    }

    public function checkInUser(string $username)
    {
        $this->recordThat(UserHasCheckedIn::occur(
            $this->aggregateId(),
            [
                'username' => $username
            ]
        ));
    }

    public function checkOutUser(string $username)
    {
        $this->recordThat(UserHasCheckedOut::occur(
            $this->aggregateId(),
            [
                'username' => $username
            ]
        ));
    }

    public function whenUserHasCheckedIn(UserHasCheckedIn $event)
    {
        $this->uuid = $event->uuid();
        $this->checkedInUsers[] = $event->username();
    }

    public function whenUserHasCheckedOut(UserHasCheckedOut $event)
    {
        $this->uuid = $event->uuid();
        unset($this->checkedInUsers[$event->username()]);
    }

    public function whenNewBuildingWasRegistered(NewBuildingWasRegistered $event)
    {
        $this->uuid = $event->uuid();
        $this->name = $event->name();
    }

    /**
     * {@inheritDoc}
     */
    protected function aggregateId() : string
    {
        return (string) $this->uuid;
    }

    /**
     * {@inheritDoc}
     */
    public function id() : string
    {
        return $this->aggregateId();
    }
}
