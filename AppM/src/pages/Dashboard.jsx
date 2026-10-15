import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../lib/api';
import TabRutas from './TabRutas';

// ─── SVG Icons ───────────────────────────────────────────────────────────────
const IconHome = ({ active }) => (
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
    <path d="M3 12L12 3l9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"
      stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" fill="none"/>
  </svg>
);
const IconGrid = ({ active }) => (
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
    <rect x="3" y="3" width="7" height="7" rx="1.5" stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2"/>
    <rect x="14" y="3" width="7" height="7" rx="1.5" stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2"/>
    <rect x="3" y="14" width="7" height="7" rx="1.5" stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2"/>
    <rect x="14" y="14" width="7" height="7" rx="1.5" stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2"/>
  </svg>
);
const IconMap = ({ active }) => (
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
    <path d="M9 3L3 6v15l6-3 6 3 6-3V3l-6 3-6-3z" stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
    <path d="M9 3v15M15 6v15" stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2" strokeLinecap="round"/>
  </svg>
);
const IconUser = ({ active }) => (
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
    <circle cx="12" cy="8" r="4" stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2"/>
    <path d="M4 20c0-3.314 3.582-6 8-6s8 2.686 8 6"
      stroke={active ? 'var(--yellow)' : '#636366'} strokeWidth="2" strokeLinecap="round"/>
  </svg>
);

// Silueta humana genérica para el header
const SilhouetteAvatar = () => (
  <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
    <rect width="36" height="36" rx="10" fill="var(--surface2)"/>
    <circle cx="18" cy="13" r="5" fill="#636366"/>
    <path d="M8 30c0-5.523 4.477-10 10-10s10 4.477 10 10" fill="#636366"/>
  </svg>
);

// ─── Componente principal ────────────────────────────────────────────────────
export default function Dashboard() {
  const navigate = useNavigate();
  const user = JSON.parse(localStorage.getItem('user') || '{}');
  const [stats, setStats] = useState(null);
  const [locales, setLocales] = useState([]);
  const [rutas, setRutas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [tab, setTab] = useState('inicio');

  useEffect(() => {
    Promise.all([api.get('/dashboard'), api.get('/locales'), api.get('/rutas')])
      .then(([s, l, r]) => {
        setStats(s.data);
        setLocales(l.data.data || []);
        setRutas(r.data || []);
      })
      .finally(() => setLoading(false));
  }, []);

  const logout = async () => {
    await api.post('/logout').catch(() => {});
    localStorage.clear();
    navigate('/');
  };

  if (loading) return (
    <div style={s.loadPage}>
      <div style={s.spinner} />
    </div>
  );

  return (
    <div style={s.app}>
      {/* ── Header ── */}
      <header style={s.header}>
        <div>
          <p style={s.headerGreet}>Bienvenido</p>
          <h1 style={s.headerName}>{user.name}</h1>
        </div>
        <SilhouetteAvatar />
      </header>

      {/* ── Contenido ── */}
      <div style={s.scroll}>
        {tab === 'inicio'    && <TabInicio stats={stats} locales={locales} />}
        {tab === 'negocios'  && <TabNegocios locales={locales} />}
        {tab === 'rutas'     && <TabRutas rutas={rutas} />}

        {tab === 'perfil'    && <TabPerfil user={user} onLogout={logout} />}
      </div>

      {/* ── Nav flotante ── */}
      <nav style={s.nav}>
        <NavBtn label="Inicio"   active={tab === 'inicio'}   onClick={() => setTab('inicio')}>
          <IconHome active={tab === 'inicio'} />
        </NavBtn>
        <NavBtn label="Negocios" active={tab === 'negocios'} onClick={() => setTab('negocios')}>
          <IconGrid active={tab === 'negocios'} />
        </NavBtn>
        <NavBtn label="Rutas"    active={tab === 'rutas'}    onClick={() => setTab('rutas')}>
          <IconMap active={tab === 'rutas'} />
        </NavBtn>
        <NavBtn label="Perfil"   active={tab === 'perfil'}   onClick={() => setTab('perfil')}>
          <IconUser active={tab === 'perfil'} />
        </NavBtn>
      </nav>
    </div>
  );
}

// ─── Tab Inicio ──────────────────────────────────────────────────────────────
function TabInicio({ stats, locales }) {
  return (
    <div style={s.tabContent}>
      {stats && (
        <>
          <SectionLabel>Resumen</SectionLabel>
          <div style={s.statsGrid}>
            <StatCard value={stats.total_locales}    label="Negocios"   accent="var(--yellow)" />
            <StatCard value={stats.total_vendedores} label="Vendedores" accent="#0a84ff" />
            <StatCard value={stats.abiertos}         label="Abiertos"   accent="#30d158" />
            <StatCard value={stats.cerrados}         label="Cerrados"   accent="#ff453a" />
          </div>
        </>
      )}

      {stats?.por_categoria?.length > 0 && (
        <>
          <SectionLabel>Categorías</SectionLabel>
          <div style={s.listGroup}>
            {stats.por_categoria.map((c, i) => (
              <div key={c.categoria}>
                <div style={s.listRow}>
                  <span style={s.listRowText}>{c.categoria || 'Sin categoría'}</span>
                  <div style={s.listRowRight}>
                    <span style={s.badge}>{c.total}</span>
                    <ChevronRight />
                  </div>
                </div>
                {i < stats.por_categoria.length - 1 && <div style={s.rowSep} />}
              </div>
            ))}
          </div>
        </>
      )}

      <SectionLabel>Recientes</SectionLabel>
      {locales.slice(0, 5).map((l) => <LocalRow key={l.id} local={l} />)}
    </div>
  );
}

// ─── Tab Negocios ────────────────────────────────────────────────────────────
function TabNegocios({ locales }) {
  return (
    <div style={s.tabContent}>
      <SectionLabel>{locales.length} negocios</SectionLabel>
      {locales.map((l) => <LocalRow key={l.id} local={l} />)}
    </div>
  );
}


// ─── Tab Perfil ──────────────────────────────────────────────────────────────
function TabPerfil({ user, onLogout }) {
  return (
    <div style={s.tabContent}>
      <div style={s.profileHero}>
        <div style={s.avatar}>{user.name?.charAt(0).toUpperCase()}</div>
        <p style={s.profileName}>{user.name}</p>
        <p style={s.profileEmail}>{user.email}</p>
      </div>

      <div style={s.listGroup}>
        <div style={s.listRow}>
          <span style={s.listRowText}>Correo</span>
          <span style={s.listRowMeta}>{user.email}</span>
        </div>
      </div>

      <button style={s.logoutBtn} onClick={onLogout}>
        Cerrar sesión
      </button>
    </div>
  );
}

// ─── Piezas reutilizables ────────────────────────────────────────────────────
function StatCard({ value, label, accent }) {
  return (
    <div style={s.statCard}>
      <p style={{ ...s.statValue, color: accent }}>{value}</p>
      <p style={s.statLabel}>{label}</p>
    </div>
  );
}

function LocalRow({ local }) {
  const initial = local.nombre?.charAt(0).toUpperCase() || '?';
  return (
    <div style={s.localRow}>
      <div style={{ ...s.localIcon, background: colorFromStr(local.categoria) }}>
        <span style={s.localInitial}>{initial}</span>
      </div>
      <div style={s.localInfo}>
        <p style={s.localName}>{local.nombre}</p>
        <p style={s.localSub}>
          {local.categoria}{local.vendedor ? ` · ${local.vendedor.nombre}` : ''}
        </p>
      </div>
      <ChevronRight />
    </div>
  );
}

function SectionLabel({ children }) {
  return <p style={s.sectionLabel}>{children}</p>;
}

function NavBtn({ children, label, active, onClick }) {
  return (
    <button style={s.navBtn} onClick={onClick}>
      {children}
      <span style={{ ...s.navLabel, color: active ? 'var(--yellow)' : '#636366' }}>{label}</span>
    </button>
  );
}

function ChevronRight() {
  return (
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
      <path d="M9 18l6-6-6-6" stroke="#48484a" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round"/>
    </svg>
  );
}

function colorFromStr(str = '') {
  const colors = ['#1c3a5e', '#1a3a2a', '#3a1c1c', '#2a1c3a', '#3a2e1c'];
  let n = 0;
  for (let i = 0; i < str.length; i++) n += str.charCodeAt(i);
  return colors[n % colors.length];
}

// ─── Estilos ─────────────────────────────────────────────────────────────────
const s = {
  app: {
    display: 'flex',
    flexDirection: 'column',
    height: '100vh',
    background: 'var(--bg)',
    overflow: 'hidden',
    position: 'relative',
  },
  loadPage: {
    flex: 1,
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    background: 'var(--bg)',
    height: '100vh',
  },
  spinner: {
    width: 32,
    height: 32,
    border: '2.5px solid var(--surface3)',
    borderTop: '2.5px solid var(--yellow)',
    borderRadius: '50%',
    animation: 'spin 0.7s linear infinite',
  },
  header: {
    display: 'flex',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: '20px 20px 14px',
    background: 'var(--bg)',
    flexShrink: 0,
  },
  headerGreet: { fontSize: 13, color: 'var(--text2)', marginBottom: 2 },
  headerName: { fontSize: 22, fontWeight: 700, letterSpacing: -0.3 },
  scroll: {
    flex: 1,
    overflowY: 'auto',
    WebkitOverflowScrolling: 'touch',
  },
  tabContent: {
    padding: '4px 20px 120px',
    animation: 'fadeIn 0.2s ease',
  },
  // Stats
  statsGrid: {
    display: 'grid',
    gridTemplateColumns: '1fr 1fr',
    gap: 10,
    marginBottom: 28,
  },
  statCard: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    padding: '16px 18px',
  },
  statValue: { fontSize: 30, fontWeight: 700, letterSpacing: -1, lineHeight: 1, marginBottom: 4 },
  statLabel: { fontSize: 12, color: 'var(--text2)', fontWeight: 500 },
  sectionLabel: {
    fontSize: 12,
    fontWeight: 600,
    textTransform: 'uppercase',
    letterSpacing: 0.8,
    color: 'var(--text2)',
    marginBottom: 10,
    marginTop: 4,
  },
  listGroup: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    marginBottom: 28,
    overflow: 'hidden',
  },
  listRow: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'space-between',
    padding: '13px 16px',
  },
  rowSep: { height: 1, background: 'var(--sep)', marginLeft: 16 },
  listRowText: { fontSize: 16, color: 'var(--text)', fontWeight: 400 },
  listRowRight: { display: 'flex', alignItems: 'center', gap: 6 },
  listRowMeta: { fontSize: 14, color: 'var(--text2)' },
  badge: {
    background: 'var(--surface2)',
    color: 'var(--text2)',
    borderRadius: 20,
    padding: '2px 9px',
    fontSize: 13,
    fontWeight: 600,
  },
  // Local row
  localRow: {
    display: 'flex',
    alignItems: 'center',
    gap: 12,
    padding: '10px 0',
    borderBottom: '1px solid var(--sep)',
  },
  localIcon: {
    width: 44,
    height: 44,
    borderRadius: 12,
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    flexShrink: 0,
  },
  localInitial: { color: '#fff', fontSize: 18, fontWeight: 700 },
  localInfo: { flex: 1, minWidth: 0 },
  localName: { fontSize: 15, fontWeight: 600, marginBottom: 2, overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' },
  localSub: { fontSize: 13, color: 'var(--text2)', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' },
  // Perfil
  profileHero: {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    paddingTop: 24,
    paddingBottom: 28,
  },
  avatar: {
    width: 72,
    height: 72,
    background: 'var(--yellow)',
    borderRadius: 22,
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    color: '#000',
    fontSize: 32,
    fontWeight: 800,
    marginBottom: 14,
  },
  profileName: { fontSize: 20, fontWeight: 700, marginBottom: 4 },
  profileEmail: { fontSize: 14, color: 'var(--text2)' },
  logoutBtn: {
    width: '100%',
    height: 50,
    background: 'var(--surface)',
    color: '#ff453a',
    border: 'none',
    borderRadius: 'var(--radius)',
    fontSize: 16,
    fontWeight: 600,
    cursor: 'pointer',
    marginTop: 8,
  },
  // Bottom nav flotante
  nav: {
    position: 'fixed',
    bottom: 24,
    left: '50%',
    transform: 'translateX(-50%)',
    width: 'calc(100% - 48px)',
    maxWidth: 382,
    display: 'flex',
    background: 'rgba(28,28,30,0.92)',
    backdropFilter: 'blur(24px)',
    WebkitBackdropFilter: 'blur(24px)',
    borderRadius: 40,
    border: '1px solid rgba(255,255,255,0.08)',
    padding: '10px 4px',
    boxShadow: '0 8px 32px rgba(0,0,0,0.5)',
    zIndex: 100,
  },
  navBtn: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    gap: 3,
    background: 'none',
    border: 'none',
    cursor: 'pointer',
    padding: '6px 0',
    borderRadius: 32,
  },
  navLabel: { fontSize: 10, fontWeight: 600, letterSpacing: 0.2 },
};
