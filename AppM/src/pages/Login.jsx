import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../lib/api';

export default function Login() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ email: '', password: '' });
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);
    try {
      const { data } = await api.post('/login', form);
      if (data.two_factor_required) navigate('/verificar', { state: { email: data.email } });
    } catch (err) {
      setError(err.response?.data?.message || 'Correo o contraseña incorrectos.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={s.page}>
      {/* Marca */}
      <div style={s.logoSection}>
        <div style={s.logoMark}>
          <span style={s.logoT}>T</span>
        </div>
        <h1 style={s.title}>Tianguis</h1>
        <p style={s.titleSub}>
          <span style={s.titleAccent}>SMT</span> · San Marcos Tlapazola
        </p>
      </div>

      {/* Form */}
      <div style={s.formSection}>
        {error && <div style={s.errorBanner}>{error}</div>}

        <div style={s.fieldGroup}>
          <div style={s.field}>
            <input
              style={s.fieldInput}
              type="email"
              placeholder="Correo electrónico"
              value={form.email}
              autoComplete="email"
              onChange={(e) => setForm({ ...form, email: e.target.value })}
              required
            />
          </div>
          <div style={s.sep} />
          <div style={s.field}>
            <input
              style={s.fieldInput}
              type="password"
              placeholder="Contraseña"
              value={form.password}
              autoComplete="current-password"
              onChange={(e) => setForm({ ...form, password: e.target.value })}
              required
            />
          </div>
        </div>

        <button
          style={loading ? { ...s.btn, opacity: 0.5 } : s.btn}
          onClick={handleSubmit}
          disabled={loading}
        >
          {loading ? 'Entrando...' : 'Iniciar sesión'}
        </button>
      </div>

      <p style={s.footer}>Tianguis SMT © 2025</p>
    </div>
  );
}

const s = {
  page: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    padding: '0 20px',
    paddingTop: '80px',
    paddingBottom: '40px',
    background: 'var(--bg)',
    animation: 'fadeIn 0.3s ease',
  },
  logoSection: {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    marginBottom: '48px',
  },
  logoMark: {
    width: 72,
    height: 72,
    background: 'var(--yellow)',
    borderRadius: 20,
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 16,
  },
  logoT: {
    color: '#000',
    fontSize: 38,
    fontWeight: 800,
    lineHeight: 1,
  },
  title: {
    fontSize: 32,
    fontWeight: 700,
    color: 'var(--text)',
    letterSpacing: -0.5,
    marginBottom: 4,
  },
  titleSub: {
    fontSize: 14,
    color: 'var(--text2)',
    letterSpacing: 0.2,
  },
  titleAccent: { color: 'var(--yellow)', fontWeight: 600 },
  formSection: { flex: 1 },
  errorBanner: {
    background: 'rgba(255,59,48,0.12)',
    border: '1px solid rgba(255,59,48,0.25)',
    color: '#ff6b6b',
    padding: '12px 16px',
    borderRadius: 'var(--radius-sm)',
    fontSize: 14,
    marginBottom: 16,
  },
  fieldGroup: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    overflow: 'hidden',
    marginBottom: 20,
  },
  field: {
    display: 'flex',
    alignItems: 'center',
    padding: '0 16px',
    height: 52,
  },
  fieldInput: {
    flex: 1,
    background: 'none',
    border: 'none',
    color: 'var(--text)',
    fontSize: 16,
    height: '100%',
  },
  sep: {
    height: 1,
    background: 'var(--sep)',
    marginLeft: 48,
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
    letterSpacing: 0.2,
  },
  footer: {
    textAlign: 'center',
    color: 'var(--text3)',
    fontSize: 13,
    marginTop: 32,
  },
};
