const API_BASE = '/challenge';
const API_ALL = '/challenges';

export const getAllChallenges = async (token) => {
  const response = await fetch(API_ALL, {
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });
  return await response.json();
};

export const getChallengeById = async (id, token) => {
  const response = await fetch(`${API_BASE}/${id}`, {
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });
  return await response.json();
};

export const createChallenge = async (challenge, token) => {
  const response = await fetch(API_BASE, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(challenge)
  });
  return await response.json();
};

export const updateChallenge = async (id, challenge, token) => {
  const response = await fetch(`${API_BASE}/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify(challenge)
  });
  return await response.json();
};

export const deleteChallenge = async (id, token) => {
  const response = await fetch(`${API_BASE}/${id}`, {
    method: 'DELETE',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });
  return await response.json();
};
