<?php
require_once __DIR__ . '/../DAL/pitchSearchData.php'; 

class PitchSearchService {
    private $pitch_searchDAL;

    public function __construct() {
        $this->pitch_searchDAL = new PitchSearchDAL();
    }

    public function getEmptyPitch() {
        $emptyId = [];

        $pitch = $this->pitch_searchDAL->getPitch();
        $order = $this->pitch_searchDAL->getOrder();

        foreach ($pitch as $football_pitches_model) {
            $is_empty = true;
            foreach ($order as $order_model) {
                if ($order_model->football_pitch_id == $football_pitches_model->id) {
                    $is_empty = false;
                    break;
                }
            }
            if ($is_empty) {
                $empty[] = $football_pitches_model;
            }
        }

        return $empty;
    }
}