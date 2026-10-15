import { useEffect, useState } from 'react';

const LAT = 19.2895;
const LON = -98.4395;
const WEATHER_KEY = 'c7db41df314738bdd95977a3d6d21131';

const WEATHER_ICONS = {
  '01': '☀', '02': '⛅', '03': '☁', '04': '☁',
  '09': '🌧', '10': '🌦', '11': '⛈', '13': '❄', '50': '🌫',
};

export default function TabRutas({ rutas }) {
  const [clima, setClima] = useState(null);
  const [climaErr, setClimaErr] = useState(false);

  useEffect(() => {
    fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${LAT}&lon=${LON}&appid=${WEATHER_KEY}&units=metric&lang=es`)
      .then(r => r.json())
      .then(d => {
        if (d.cod && d.cod !== 200) throw new Error();
        setClima(d);
      })
      .catch(() => setClimaErr(true));
  }, []);

  const getWeatherIcon = (icon = '') => {
    const code = icon.replace('d', '').replace('n', '');
    return WEATHER_ICONS[code] || '🌤';
  };

  return (
    <div style={s.page}>

      {/* ── Clima ── */}
      <SectionLabel>Clima actual</SectionLabel>
      <div style={s.climaCard}>
        {!clima && !climaErr && <p style={s.climaMuted}>Cargando clima...</p>}
        {climaErr && <p style={s.climaMuted}>No se pudo cargar el clima</p>}
        {clima && (
          <div style={s.climaInner}>
            <div style={s.climaLeft}>
              <span style={s.climaIconBig}>{getWeatherIcon(clima.weather[0].icon)}</span>
              <div>
                <p style={s.climaTemp}>{Math.round(clima.main.temp)}<span style={s.climaTempUnit}>°C</span></p>
                <p style={s.climaDesc}>{clima.weather[0].description}</p>
              </div>
            </div>
            <div style={s.climaGrid}>
              <ClimaItem label="Sensación"  value={`${Math.round(clima.main.feels_like)}°C`} />
              <ClimaItem label="Humedad"    value={`${clima.main.humidity}%`} />
              <ClimaItem label="Viento"     value={`${Math.round(clima.wind.speed * 3.6)} km/h`} />
              <ClimaItem label="Mín / Máx"  value={`${Math.round(clima.main.temp_min)}° / ${Math.round(clima.main.temp_max)}°`} />
            </div>
          </div>
        )}
      </div>

      {/* ── Transporte ── */}
      <SectionLabel>Opciones de transporte</SectionLabel>
      <div style={s.transportGrid}>
        <TransCard
          title="Transporte Público"
          body={<>Rutas directas desde <b style={s.bold}>CAPU Puebla</b> con AU y Estrella Roja. Parada frente al Carril de San Miguel.</>}
          footer="Salidas cada 20 min aprox."
        />
        <TransCard
          title="Auto Particular"
          body={<>Salida <b style={s.bold}>"San Martín"</b> de la Autopista México-Puebla. Estacionamiento disponible en Zona B.</>}
          footer="Estacionamiento gratuito"
        />
        <div style={s.transCard}>
          <p style={s.transTitle}>Zonas del Tianguis</p>
          <div style={s.zonaList}>
            <ZonaRow color="var(--yellow)" zona="A" label="Ropa y Textiles" />
            <ZonaRow color="#3a3a3c"       zona="B" label="Calzado" />
            <ZonaRow color="#636366"       zona="C" label="Comida y Varios" />
          </div>
        </div>
      </div>

      {/* ── Ride buttons ── */}
      <SectionLabel>Pedir un ride</SectionLabel>
      <div style={s.rideCard}>
        <p style={s.rideAddress}>Tianguis de San Martín Texmelucan, Puebla</p>
        <p style={s.rideCoordsText}>19.2895° N, 98.4395° O</p>
        <div style={s.rideButtons}>
          <RideBtn
            label="Uber"
            bg="#fff"
            color="#000"
            href={`https://m.uber.com/ul/?action=setPickup&pickup=my_location&dropoff[formatted_address]=Tianguis%20San%20Mart%C3%ADn%20Texmelucan&dropoff[latitude]=${LAT}&dropoff[longitude]=${LON}`}
          />
          <RideBtn
            label="DiDi"
            bg="#ff6600"
            color="#fff"
            href={`https://page.didiglobal.com/mx/?to_lat=${LAT}&to_lng=${LON}&to_name=Tianguis+San+Mart%C3%ADn`}
          />
          <RideBtn
            label="Maps"
            bg="var(--yellow)"
            color="#000"
            href={`https://www.google.com/maps/dir/?api=1&destination=${LAT},${LON}`}
          />
          <RideBtn
            label="Waze"
            bg="var(--surface2)"
            color="var(--yellow)"
            href={`https://waze.com/ul?ll=${LAT},${LON}&navigate=yes`}
          />
        </div>
      </div>

      {/* ── Locales con ubicación ── */}
      {rutas.length > 0 && (
        <>
          <SectionLabel>{rutas.length} locales con ubicación</SectionLabel>
          <div style={s.listGroup}>
            {rutas.map((local, i) => (
              <div key={local.id}>
                <button
                  style={s.rutaRow}
                  onClick={() => window.open(`https://maps.google.com/?q=${local.latitud},${local.longitud}`, '_blank')}
                >
                  <div style={s.rutaPin} />
                  <div style={s.rutaInfo}>
                    <p style={s.rutaNombre}>{local.nombre}</p>
                    <p style={s.rutaSub}>
                      {local.categoria}{local.ubicacion ? ` · ${local.ubicacion}` : ''}
                    </p>
                  </div>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"
                      stroke="var(--yellow)" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                  </svg>
                </button>
                {i < rutas.length - 1 && <div style={s.rowSep} />}
              </div>
            ))}
          </div>
        </>
      )}
    </div>
  );
}

// ─── Sub-componentes ──────────────────────────────────────────────────────────

function ClimaItem({ label, value }) {
  return (
    <div>
      <p style={s.climaItemLabel}>{label}</p>
      <p style={s.climaItemValue}>{value}</p>
    </div>
  );
}

function TransCard({ title, body, footer }) {
  return (
    <div style={s.transCard}>
      <p style={s.transTitle}>{title}</p>
      <p style={s.transBody}>{body}</p>
      <div style={s.transFooter}>
        <p style={s.transFooterText}>{footer}</p>
      </div>
    </div>
  );
}

function ZonaRow({ color, zona, label }) {
  return (
    <div style={s.zonaRow}>
      <span style={{ ...s.zonaColor, background: color }} />
      <span style={s.zonaText}>Zona <b style={{ color: 'var(--text)' }}>{zona}</b> — {label}</span>
    </div>
  );
}

function RideBtn({ label, bg, color, href }) {
  return (
    <a href={href} target="_blank" rel="noopener noreferrer" style={{ ...s.rideBtn, background: bg, color }}>
      {label}
    </a>
  );
}

function SectionLabel({ children }) {
  return <p style={s.sectionLabel}>{children}</p>;
}

// ─── Estilos ──────────────────────────────────────────────────────────────────
const s = {
  page: { padding: '4px 20px 120px', animation: 'fadeIn 0.2s ease' },
  sectionLabel: {
    fontSize: 11,
    fontWeight: 700,
    textTransform: 'uppercase',
    letterSpacing: 1,
    color: 'var(--text2)',
    marginBottom: 10,
    marginTop: 8,
  },
  // Clima
  climaCard: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    borderLeft: '3px solid var(--yellow)',
    padding: '16px',
    marginBottom: 24,
  },
  climaMuted: { color: 'var(--text2)', fontSize: 14 },
  climaInner: { display: 'flex', flexDirection: 'column', gap: 14 },
  climaLeft: { display: 'flex', alignItems: 'center', gap: 12 },
  climaIconBig: { fontSize: 36, lineHeight: 1 },
  climaTemp: { fontSize: 32, fontWeight: 800, letterSpacing: -1, lineHeight: 1, color: 'var(--text)', margin: 0 },
  climaTempUnit: { fontSize: 16, fontWeight: 400, color: 'var(--text2)' },
  climaDesc: { fontSize: 12, color: 'var(--text2)', textTransform: 'capitalize', marginTop: 2 },
  climaGrid: { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '10px 16px' },
  climaItemLabel: { fontSize: 10, fontWeight: 700, textTransform: 'uppercase', letterSpacing: 0.8, color: 'var(--text2)', margin: '0 0 2px' },
  climaItemValue: { fontSize: 15, fontWeight: 700, color: 'var(--text)', margin: 0 },
  // Transporte
  transportGrid: { display: 'flex', flexDirection: 'column', gap: 10, marginBottom: 24 },
  transCard: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    borderLeft: '3px solid var(--yellow)',
    padding: '16px',
  },
  transTitle: { fontSize: 12, fontWeight: 700, textTransform: 'uppercase', letterSpacing: 0.8, color: 'var(--text)', margin: '0 0 8px' },
  transBody: { fontSize: 13, color: 'var(--text2)', lineHeight: 1.6, margin: '0 0 12px' },
  bold: { color: 'var(--text)', fontWeight: 700 },
  transFooter: {
    borderLeft: '2px solid var(--yellow)',
    paddingLeft: 10,
  },
  transFooterText: { fontSize: 12, color: 'var(--text2)', margin: 0 },
  zonaList: { display: 'flex', flexDirection: 'column', gap: 8 },
  zonaRow: { display: 'flex', alignItems: 'center', gap: 8 },
  zonaColor: { width: 10, height: 10, borderRadius: 2, flexShrink: 0 },
  zonaText: { fontSize: 13, color: 'var(--text2)' },
  // Ride
  rideCard: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    borderLeft: '3px solid var(--yellow)',
    padding: '16px',
    marginBottom: 24,
  },
  rideAddress: { fontSize: 14, fontWeight: 600, color: 'var(--text)', margin: '0 0 2px' },
  rideCoordsText: { fontSize: 12, color: '#636366', margin: '0 0 14px' },
  rideButtons: { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 8 },
  rideBtn: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    height: 42,
    borderRadius: 10,
    fontSize: 14,
    fontWeight: 700,
    textDecoration: 'none',
    letterSpacing: 0.3,
  },
  // Locales
  listGroup: {
    background: 'var(--surface)',
    borderRadius: 'var(--radius)',
    overflow: 'hidden',
    marginBottom: 16,
  },
  rowSep: { height: 1, background: 'rgba(255,255,255,0.06)', marginLeft: 52 },
  rutaRow: {
    width: '100%',
    display: 'flex',
    alignItems: 'center',
    gap: 12,
    padding: '13px 16px',
    background: 'none',
    border: 'none',
    cursor: 'pointer',
    textAlign: 'left',
  },
  rutaPin: {
    width: 10,
    height: 10,
    borderRadius: '50%',
    background: 'var(--yellow)',
    flexShrink: 0,
    marginLeft: 6,
  },
  rutaInfo: { flex: 1, minWidth: 0 },
  rutaNombre: { fontSize: 15, fontWeight: 600, color: 'var(--text)', margin: '0 0 2px', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' },
  rutaSub: { fontSize: 12, color: 'var(--text2)', margin: 0, overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' },
};
