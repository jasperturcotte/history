<?php

namespace History;

/**
 * A thing.
 */
class Thing
{
    /**
     * @var int $_idCounter The global ID counter.
     */
    static int $_idCounter = 1;

    /**
     * Resets the global counter.
     */
    static function resetCounter(): void
    {
        self::$_idCounter = 1;
    }

    /**
     * @var string $name The name of the thing.
     * @var int $id The unique ID of the thing.
     */
    var string $name;
    var string $id;

    /**
     * @var Thing $parent The parent thing.
     * @var array $children The children things.
     * @var int $numChildren Current number of children.
     */
    var ?Thing $parent = NULL;
    var array $children = [];
    var int $numChildren = 0;

    /**
     * Constructor
     */
    function __construct($opts = [])
    {
        if (isset($opts['id'])) {
            $this->id = $opts['id'];
        } else {
            $this->id = self::$_idCounter;
            self::$_idCounter++;
        }
    }

    /**
     * Sets the parent object. If this is already a child of another object
     *   it will be removed from the old parent.
     * 
     * @param Thing &$parent
     *   The parent object.
     */
    function setParent(Thing &$parent): void
    {
        if ($this->parent && $this->parent->id != $parent->id) {
            $this->parent->removeChild($this);
        }
        $this->parent = $parent;
    }

    /**
     * Clears the parent relationship.
     * 
     * @return Thing
     *   The parent.
     */
    function clearParent(): Thing
    {
        $parent = $this->parent;
        $parent->removeChild($this);
        $this->parent = NULL;
        return $parent;
    }

    /**
     * Adds a child. This will not add duplicates.
     * 
     * @param Thing &$child
     *   The child to add.
     */
    function addChild(Thing &$child): void
    {
        $index = array_search($child, $this->children);

        // Avoid duplicate
        if ($index === FALSE) {
            $this->children[] = $child;
        }

        $child->setParent($this);
        $this->recalculateChildren();
    }

    /**
     * Removes a child, if it exists.
     * 
     * @param Thing &$child
     *   The child to remove.
     * 
     * @return Thing
     *   The child removed, if any.
     */
    function removeChild(Thing &$child): ?Thing
    {
        $index = array_search($child, $this->children);
        if ($index !== FALSE) {
            array_splice($this->children, $index);
            $child->clearParent();
            $this->recalculateChildren();

            return $child;
        }

        return NULL;
    }

    /**
     * Recalculates how many children there are.
     */
    function recalculateChildren(): void
    {
        $this->numChildren = count($this->children);
    }

    /**
     * An iteration of running the thing, and all children.
     */
    function run(float $delta = 0):void {
        foreach($this->children as $child) {
            $child->run($delta);
        }
    }


}
