<?php
namespace Lumav\DaireStudyUnit1review\Plugin;

use Magento\Review\Model\Review;
/**
 * Plugin for Custom Review validation
 */
class ReviewPlugin  {
    public function afterValidate(Review $subject, $result) {
        if(preg_match('/-/',$subject->getNickname())) {
            $result = [];
            $result[] = __('Dashes are not allowed.');
        }
        return $result;
    }
}
