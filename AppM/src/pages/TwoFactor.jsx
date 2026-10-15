import { useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import api from '../lib/api';

export default function TwoFactor() {
  const navigate = useNavigate();
  const location = useLocation();
  const email = location.state?.email || '';
  const [code, setCode] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);
    try {
      const { data } = await api.post('/two-factor/verify', { email, code });
      localStorage.setItem('token', data.token);
      localStorage.setItem('user', JSON.stringify(data.user));
      navigate('/dashboard');
    } catch (err) {
      setError(err.response?.data?.message || 'Código incorrecto.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={s.page}>
      <button style={s.back} onClick={() => navigate('/')}>
        ‹ Volver
      </button>

      <div style={s.top}>
        <h1 style={s.title}>Verifica tu identidad</h1>
        <p style={s.subtitle}>
          Enviamos un código de 6 dígitos a{'\n'}
          <span style={s.email}>{email}</span>
        </p>
      </div>

      {error && <div style={s.errorBanner}>{error}</div>}

      <div style={s.codeGroup}>
        <input
          style={s.codeInput}
          type="number"
          inputMode="numeric"
          placeholder="000000"
          value={code}
          onChange={(e) => setCode(e.target.value.slice(0, 6))}
          required
        />
      </div>

      <button
        style={loading ? { ...s.btn, opacity: 0.5 } : s.btn}
        onClick={handleSubmit}
        disabled={loading}
      >
        {loading ? 'Verificando...' : 'Confirmar código'}
      </button>

      <p style={s.hint}>El código expira en 10 minutos</p>
    </div>
  );
}

const s = {
  page: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    padding: '0 20px 40px',
    paddingTop: '20px',
    background: 'var(--bg)',
    animation: 'fadeIn 0.3s ease',
  },
  back: {
    alignSelf: 'flex-start',
    background: 'none',
    border: 'none',
    color: 'var(--yellow)',
    fontSize: 17,
    cursor: 'pointer',
    padding: '8px 0',
    marginBottom: 32,
  },
  top: {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    textAlign: 'center',
    marginBottom: 36,
  },
  title: {
    fontSize: 26,
    fontWeight: 700,
    letterSpacing: -0.3,
    marginBottom: 10,
  },
  subtitle: {
    color: 'var(--text2)',
    fontSize: 15,
    lineHeight: 1.5,
    whiteSpace: 'pre-line',
  },
  email: { color: 'var(--yellow)', fontWeight: 600 },
  errorBanner: {
    background: 'rgba(255,59,48,0.12)',
    border: '1px solid rgba(255,59,48,0.25)',
    color: '#ff6b6b',
    padding: '12px 16px',
    borderRadius: 'var(--radius-sm)',
    fontSize: 14,
    marginBottom: 16,
  },
  codeGroup: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    marginBottom: 16,
    overflow: 'hidden',
  },
  codeInput: {
    width: '100%',
    height: 68,
    background: 'none',
    border: 'none',
    color: 'var(--text)',
    fontSize: 36,
    fontWeight: 700,
    textAlign: 'center',
    letterSpacing: 12,
  },
  btn: {
    width: '100%',
    height: 54,
    background: 'var(--yellow)',
    color: '#000',
    border: 'none',
    borderRadius: 'var(--radius)',
    fontSize: 17,
    fontWeight: 700,
    cursor: 'pointer',
  },
  hint: {
    textAlign: 'center',
    color: 'var(--text3)',
    fontSize: 13,
    marginTop: 16,
  },
};
