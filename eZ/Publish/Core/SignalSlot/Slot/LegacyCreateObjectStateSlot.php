<?php
/**
 * File containing the Legacy\LegacyCreateObjectStateSlot class
 *
 * @copyright Copyright (C) 1999-2014 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\Core\SignalSlot\Slot;

use eZ\Publish\Core\SignalSlot\Signal;

/**
 * A legacy slot handling CreateObjectStateSignal.
 */
class LegacyCreateObjectStateSlot extends AbstractLegacyObjectStateSlot
{
    /**
     * Receive the given $signal and react on it
     *
     * @param \eZ\Publish\Core\SignalSlot\Signal $signal
     */
    public function receive( Signal $signal )
    {
        if ( !$signal instanceof Signal\ObjectStateService\CreateObjectStateSignal )
        {
            return;
        }

        parent::receive( $signal );
    }
}
