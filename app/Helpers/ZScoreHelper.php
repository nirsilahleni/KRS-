<?php

use App\Models\StandarDeviasi;

if (!function_exists("zscore")) {
    function zscore(StandarDeviasi $standarDeviasi, float $value)
    {
        switch($standarDeviasi->type){
            case "BB":
                if($value < $standarDeviasi->{"-3sd"}){
                    return "Berat badan sangat kurang (severly underweight)";
                }else if($value >= $standarDeviasi->{"-3sd"} && $value < $standarDeviasi->{"-2sd"}){
                    return "Berat badan kurang (underweight)";
                }else if($value >= $standarDeviasi->{"-2sd"} && $value < $standarDeviasi->{"1sd"}){
                    return "Berat badan normal";
                }else{
                    return "Berat badan lebih (overweight)";
                }
                break;
            case "TB":
                if($value < $standarDeviasi->{"-3sd"}){
                    return "Tinggi badan sangat pendek (severly stunted)";
                }else if($value >= $standarDeviasi->{"-3sd"} && $value < $standarDeviasi->{"-2sd"}){
                    return "Tinggi badan pendek (stunted)";
                }else if($value >= $standarDeviasi->{"-2sd"} && $value < $standarDeviasi->{"3sd"}){
                    return "Tinggi badan normal";
                }else{
                    return "Tinggi badan lebih (tall)";
                }
                break;
            default:
                return "Invalid type";
        }
    }
}

