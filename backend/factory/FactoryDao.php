<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/MealDao.php';
require_once __DIR__ . '/../dao/WorkoutDao.php';
require_once __DIR__ . '/../dao/WeightDao.php';
// add other DAOs as needed

class DaoFactory {
    public static function create($type) {
        return match($type) {
            'users' => new UserDao(),
            'meals' => new MealDao(),
            'workouts' => new WorkoutDao(),
            'weights' => new WeightDao(),
            default => throw new Exception("Unknown DAO type: $type"),
        };
    }
}
