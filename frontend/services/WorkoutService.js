const API_URL = '/workout';

export const getAllWorkouts = async (token) => {
  const response = await fetch('/workouts', {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to fetch workouts');
  return await response.json();
};

export const getWorkoutById = async (id, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to fetch workout');
  return await response.json();
};

export const createWorkout = async (workoutData, token) => {
  const response = await fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(workoutData)
  });

  if (!response.ok) throw new Error('Failed to add workout');
  return await response.json();
};

export const updateWorkout = async (id, updatedData, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(updatedData)
  });

  if (!response.ok) throw new Error('Failed to update workout');
  return await response.json();
};

export const deleteWorkout = async (id, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'DELETE',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to delete workout');
  return await response.json();
};
