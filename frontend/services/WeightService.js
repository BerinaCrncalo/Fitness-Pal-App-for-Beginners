const API_URL = '/weight';

export const getAllWeights = async (token) => {
  const response = await fetch('/weights', {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to fetch weights');
  return await response.json();
};

export const getWeightById = async (id, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to fetch weight entry');
  return await response.json();
};

export const createWeight = async (weightData, token) => {
  const response = await fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(weightData)
  });

  if (!response.ok) throw new Error('Failed to add weight');
  return await response.json();
};

export const updateWeight = async (id, updatedData, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(updatedData)
  });

  if (!response.ok) throw new Error('Failed to update weight');
  return await response.json();
};

export const deleteWeight = async (id, token) => {
  const response = await fetch(`${API_URL}/${id}`, {
    method: 'DELETE',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

  if (!response.ok) throw new Error('Failed to delete weight');
  return await response.json();
};
