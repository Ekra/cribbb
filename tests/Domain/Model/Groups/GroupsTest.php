<?php namespace Cribbb\Tests\Domain\Model\Groups;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Groups\Name;
use Cribbb\Domain\Model\Groups\Slug;
use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;

class GroupsTest extends \PHPUnit_Framework_TestCase
{
    /** @var GroupId */
    private $id;

    /** @var Name */
    private $name;

    /** @var Slug */
    private $slug;

    public function setUp()
    {
        $this->id   = new GroupId(Uuid::uuid4());
        $this->name = new Name('Cribbb');
        $this->slug = new Slug('cribbb');
    }

    /** @test */
    public function should_require_group_id()
    {
        $this->setExpectedException('Exception');

        $group = new Group(null, $this->name, $this->slug);
    }

    /** @test */
    public function should_require_name()
    {
        $this->setExpectedException('Exception');

        $group = new Group($this->id, null, $this->slug);
    }

    /** @test */
    public function should_require_slug()
    {
        $this->setExpectedException('Exception');

        $group = new Group($this->id, $this->name, null);
    }

    /** @test */
    public function should_create_new_group()
    {
        $group = new Group($this->id, $this->name, $this->slug);

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
        $this->assertEquals($this->id,   $group->id());
        $this->assertEquals($this->name, $group->name());
        $this->assertEquals($this->slug, $group->slug());
    }
}