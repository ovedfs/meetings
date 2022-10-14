<?php
  
namespace App\Enums;

enum MeetingEnum:int {
    case Programada = 1;
    case Reagendada = 2;
    case Cancelada = 3;
    case Confirmada = 4;
    case Completada = 5;
}