async function apiRequest(url, options = {}) {
  const token = localStorage.getItem('jwt_token');
  const tokenType = localStorage.getItem('token_type') || 'Bearer';

  const headers = {
    'Content-Type': 'application/json',
    ...(options.headers || {})
  };

  if (token) {
    headers['Authorization'] = `${tokenType} ${token}`;
  }

  const response = await fetch(url, {
    ...options,
    headers
  });

  if (response.status === 401) {
    localStorage.clear();
    window.location.href = `${window.location.origin}/logout`;
    return { status: 'failed', message: 'Unauthorized' };
  }

  let data;
  try {
    data = await response.json();
  } catch {
    data = { status: 'failed', message: 'Invalid response format' };
  }

  return data;
}

const Api = {
  get: (url) => apiRequest(url),
  post: (url, body) => apiRequest(url, { method: 'POST', body: JSON.stringify(body) }),
  put: (url, body) => apiRequest(url, { method: 'PUT', body: JSON.stringify(body) }),
  patch: (url, body) => apiRequest(url, { method: 'PATCH', body: JSON.stringify(body) }),
  del: (url) => apiRequest(url, { method: 'DELETE' })
};
