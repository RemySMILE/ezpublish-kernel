<?php
/**
 * File containing the ezp\content\Version class.
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package ezp
 * @subpackage content
 */

/**
 * This class represents a Content Version
 *
 * @package ezp
 * @subpackage content
 *
 * @property-read int $id
 * @property-read int $version
 * @property int $userId
 * @property int $creatorId
 * @property-read ContentField[] $fields An hash structure of fields
 */
namespace ezp\content;
class Version extends \ezp\base\AbstractModel implements \ezp\base\ObserverInterface
{
    /**
     * @var array Readable of properties on this object
     */
    protected $readableProperties = array(
        'id' => false,
        'version' => false,
        'userId' => true,
        'creatorId' => true,
        'created' => true,
        'modified' => true,
        'locale' => true,
        'fields' => false,
        'content' => false,
    );

    /**
     * @var array Dynamic properties on this object
     */
    protected $dynamicProperties = array(
        'locale' => false,
        'baseVersion' => false,
    );

    /**
     * Create content version based on content and content type fields objects
     *
     * @param Content $content
     */
    public function __construct( Content $content )
    {
        $this->content = $content;
        $this->fields = new FieldCollection( $this );
    }

    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var int
     */
    protected $version = 0;

    /**
     * @var int
     */
    protected $userId = 0;

    /**
     * @var int
     */
    protected $creatorId = 0;

    /**
     * @var int
     */
    protected $created = 0;

    /**
     * @var int
     */
    protected $modified = 0;

    /**
     * @var int
     */
    protected $status = 0;

    /**
     * @var Field[]
     */
    protected $fields;

    /**
     * Content object this version is attached to.
     *
     * @var Content
     */
    protected $content;

    /**
     * Locale
     *
     * @var \ezp\base\Locale
     */
    protected $locale;

    /**
     * Version on which was the base to create the current one
     *
     * @var Version
     */
    protected $baseVersion;

    /**
     * Called when subject has been updated
     *
     * @param \ezp\base\ObservableInterface $subject
     * @param string $event
     * @return Version
     */
    public function update( \ezp\base\ObservableInterface $subject, $event = 'update' )
    {
        if ( $subject instanceof Content )
        {
            return $this->notify( $event );
        }
        return $this;
    }


    /**
     * Sets the locale of the version
     *
     * @param Locale $locale
     */
    protected function setLocale( Locale $locale )
    {
        $this->locale = $locale;
    }

    /**
     * Returns the Version used as a base of the current one
     *
     * @return Version|false
     */
    protected function getBaseVersion()
    {
        if ( $this->base instanceof Proxy )
        {
            $this->base = $this->base->load();
        }
        return $this->base;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id . ' ('  . $this->version . ')';
    }


    /**
     * Clones the version and set the base of the new version object with the
     * old one.
     *
     * @return void
     */
    public function __clone()
    {
        $this->base = $this;
        $this->id = false;
    }
}
?>
