<?php
/**
 * File containing the eZ\Publish\API\Repository\ObjectStateService class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package eZ\Publish\API\Repository
 */

namespace eZ\Publish\Core\Repository;

use eZ\Publish\API\Repository\ObjectStateService as ObjectStateServiceInterface,
    eZ\Publish\API\Repository\Repository as RepositoryInterface,
    eZ\Publish\SPI\Persistence\Handler,

    eZ\Publish\API\Repository\Values\ObjectState\ObjectStateUpdateStruct,
    eZ\Publish\API\Repository\Values\ObjectState\ObjectStateCreateStruct,
    eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroupUpdateStruct,
    eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroup,
    eZ\Publish\API\Repository\Values\Content\ContentInfo,
    eZ\Publish\API\Repository\Values\ObjectState\ObjectState,
    eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroupCreateStruct;

/**
 * ObjectStateService service
 *
 * @example Examples/objectstates.php tbd.
 *
 * @package eZ\Publish\Core\Repository
 */
class ObjectStateService implements ObjectStateServiceInterface
{
    /**
     * @var \eZ\Publish\API\Repository\Repository
     */
    protected $repository;

    /**
     * @var \eZ\Publish\SPI\Persistence\Handler
     */
    protected $persistenceHandler;

    /**
     * @var array
     */
    protected $settings;

    /**
     * Setups service with reference to repository object that created it & corresponding handler
     *
     * @param \eZ\Publish\API\Repository\Repository $repository
     * @param \eZ\Publish\SPI\Persistence\Handler $handler
     * @param array $settings
     */
    public function __construct( RepositoryInterface $repository, Handler $handler, array $settings = array() )
    {
        $this->repository = $repository;
        $this->persistenceHandler = $handler;
        $this->settings = $settings;
    }

    /**
     * Creates a new object state group
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to create an object state group
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroupCreateStruct $objectStateGroupCreateStruct
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup
     */
    public function createObjectStateGroup( ObjectStateGroupCreateStruct $objectStateGroupCreateStruct ) {}

    /**
     * Loads a object state group
     *
     * @param mixed $objectStateGroupId
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\NotFoundException if the group was not found
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup
     */
    public function loadObjectStateGroup( $objectStateGroupId ) {}

    /**
     * Loads all object state groups
     *
     * @param int $offset
     * @param int $limit
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup[]
     */
    public function loadObjectStateGroups( $offset = 0, $limit = -1 ) {}

    /**
     * This method returns the ordered list of object states of a group
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup $objectStateGroup
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectState[]
     */
    public function loadObjectStates( ObjectStateGroup $objectStateGroup ) {}

    /**
     * Updates an object state group
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to update an object state group
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup $objectStateGroup
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroupUpdateStruct $objectStateGroupUpdateStruct
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup
     */
    public function updateObjectStateGroup( ObjectStateGroup $objectStateGroup, ObjectStateGroupUpdateStruct $objectStateGroupUpdateStruct ) {}

    /**
     * Deletes a object state group including all states and links to content
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to delete an object state group
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup $objectStateGroup
     */
    public function deleteObjectStateGroup( ObjectStateGroup $objectStateGroup ) {}

    /**
     * Creates a new object state in the given group.
     *
     * Note: in current kernel: If it is the first state all content objects will
     * set to this state.
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to create an object state
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup $objectStateGroup
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateCreateStruct $objectStateCreateStruct
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectState
     */
    public function createObjectState( ObjectStateGroup $objectStateGroup, ObjectStateCreateStruct $objectStateCreateStruct ) {}

    /**
     * Loads an object state
     *
     * @param $stateId
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\NotFoundException if the state was not found
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectState
     */
    public function loadObjectState( $stateId ) {}

    /**
     * Updates an object state
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to update an object state
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectState $objectState
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateUpdateStruct $objectStateUpdateStruct
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectState
     */
    public function updateObjectState( ObjectState $objectState, ObjectStateUpdateStruct $objectStateUpdateStruct ) {}

    /**
     * Changes the priority of the state
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to change priority on an object state
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectState $objectState
     * @param int $priority
     */
    public function setPriorityOfObjectState( ObjectState $objectState, $priority ) {}

    /**
     * Deletes a object state. The state of the content objects is reset to the
     * first object state in the group.
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to delete an object state
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectState $objectState
     */
    public function deleteObjectState( ObjectState $objectState ) {}

    /**
     * Sets the object-state of a state group to $state for the given content.
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\InvalidArgumentException if the object state does not belong to the given group
     * @throws \eZ\Publish\API\Repository\Exceptions\UnauthorizedException if the user is not allowed to change the object state
     *
     * @param \eZ\Publish\API\Repository\Values\Content\ContentInfo $contentInfo
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup $objectStateGroup
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectState $objectState
     */
    public function setObjectState( ContentInfo $contentInfo, ObjectStateGroup $objectStateGroup, ObjectState $objectState ) {}

    /**
     * Gets the object-state of object identified by $contentId.
     *
     * The $state is the id of the state within one group.
     *
     * @param \eZ\Publish\API\Repository\Values\Content\ContentInfo $contentInfo
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectStateGroup $objectStateGroup
     *
     * @return \ez\Publish\API\Repository\Values\ObjectState\ObjectState
     */
    public function getObjectState( ContentInfo $contentInfo, ObjectStateGroup $objectStateGroup ) {}

    /**
     * Returns the number of objects which are in this state
     *
     * @param \ez\Publish\API\Repository\Values\ObjectState\ObjectState $objectState
     *
     * @return int
     */
    public function getContentCount( ObjectState $objectState ) {}

    /**
     * Instantiates a new Object State Group Create Struct and sets $identified in it.
     *
     * @param string $identifier
     * @return \eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroupCreateStruct
     */
    public function newObjectStateGroupCreateStruct( $identifier ) {}

    /**
     * Instantiates a new Object State Group Update Struct.
     *
     * @return \eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroupUpdateStruct
     */
    public function newObjectStateGroupUpdateStruct() {}

    /**
     * Instantiates a new Object State Create Struct and sets $identifier in it.
     *
     * @param string $identifier
     * @return \eZ\Publish\API\Repository\Values\ObjectState\ObjectStateCreateStruct
     */
    public function newObjectStateCreateStruct( $identifier ) {}

    /**
     * Instantiates a new Object State Update Struct.
     *
     * @return \eZ\Publish\API\Repository\Values\ObjectState\ObjectStateUpdateStruct
     */
    public function newObjectStateUpdateStruct() {}
}
