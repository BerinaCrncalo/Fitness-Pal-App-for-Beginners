const API_URL = '/workoutplan';

export const getAllWorkoutPlans = async (token) => {
  const response = await fetch(API_URL, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to fetch workout plans');
  return await response.json();
};

export const getWorkoutPlanById = async (id, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to fetch workout plan');
  return await response.json();
};

export const createWorkoutPlan = async (planData, token) => {
  const response = await fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(planData)
  });

  if (!response.ok) throw new Error('Failed to add workout plan');
  return await response.json();
};

export const updateWorkoutPlan = async (id, updatedData, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(updatedData)
  });

  if (!response.ok) throw new Error('Failed to update workout plan');
  return await response.json();
};

export const deleteWorkoutPlan = async (id, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'DELETE',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to delete workout plan');
  return await response.json();
};
