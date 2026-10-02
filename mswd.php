<?php
require_once 'aics/connection.php';
$logos = []; $activePrimary =$activeSecondary = null;
if ($result =$conn->query("SELECT logo_path,logo_type,is_active FROM system_logos ORDER BY logo_type,is_active DESC,created_at DESC,id DESC")) {
    while ($row =$result->fetch_assoc()) {
        if ((int)$row['is_active']) {
            if ($row['logo_type'] === 'primary' && !$activePrimary) $activePrimary = ltrim($row['logo_path'], './');
            if ($row['logo_type'] === 'secondary' && !$activeSecondary) $activeSecondary = ltrim($row['logo_path'], './');
        }
    }
    $result->free();
}
?>
<!DOCTYPE html>
<html lang="en" class="h-screen w-screen overflow-hidden dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MSWD Assistance Portal - GAD Building, San Juan, La Union</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            mswd: {
              red: '#830000',
              hoverRed: '#660000',
              accent: '#a81313'
            }
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    body, button, input, select, textarea, a {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "SF Pro Display", "Segoe UI", Roboto, sans-serif;
    }
    .grid-bg {
      background-size: 24px 24px;
      background-image: radial-gradient(circle, rgba(148, 163, 184, 0.12) 1px, transparent 1px);
    }
    .dark .grid-bg {
      background-image: radial-gradient(circle, rgba(51, 65, 85, 0.2) 1px, transparent 1px);
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.8);
    }
    .dark .glass-card {
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .glass-card-hover:hover {
      background: rgba(255, 255, 255, 0.9);
      border-color: rgba(131, 0, 0, 0.3);
    }
    .dark .glass-card-hover:hover {
      background: rgba(30, 41, 59, 0.85);
      border-color: rgba(131, 0, 0, 0.5);
    }
  </style>
  <script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-100 h-screen w-screen overflow-hidden flex flex-col justify-between p-3 sm:p-5 select-none relative antialiased transition-colors duration-300 grid-bg">

  <!-- AMBIENT LIGHT GLOW BACKGROUNDS -->
  <div class="fixed top-1/4 -left-20 w-80 h-80 bg-blue-500/10 dark:bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
  <div class="fixed bottom-1/4 -right-20 w-80 h-80 bg-mswd-red/10 dark:bg-mswd-red/15 rounded-full blur-3xl pointer-events-none"></div>

  <!-- HEADER -->
  <header class="w-full max-w-5xl mx-auto flex items-center justify-between glass-card rounded-2xl p-2.5 px-4 shrink-0 gap-3 relative z-10 shadow-sm transition-all duration-300">
    <div class="flex items-center gap-2.5">
      <div class="w-8 h-8 flex items-center justify-center shrink-0 overflow-hidden rounded-xl bg-white/80 dark:bg-slate-800/80 p-1 border border-slate-200/80 dark:border-slate-700/60 backdrop-blur-md">
        <?php if ($activePrimary): ?>
          <img src="<?= htmlspecialchars($activePrimary) ?>" alt="Primary Logo" class="w-full h-full object-contain">
        <?php else: ?>
          <svg class="w-full h-full text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="12" r="3" fill="#830000"/></svg>
        <?php endif; ?>
      </div>
      <div class="text-left leading-tight hidden sm:block">
        <span class="inline-block text-[8px] font-extrabold text-slate-400 dark:text-slate-500 tracking-wider uppercase">Republic of the Philippines</span>
        <p class="text-[11px] font-black text-slate-900 dark:text-slate-100 tracking-tight uppercase">San Juan, La Union</p>
      </div>
    </div>

    <div class="text-center flex flex-col items-center justify-center">
      <span class="inline-flex items-center gap-1.5 bg-slate-900/90 dark:bg-slate-100/90 text-white dark:text-slate-900 text-[8px] px-2.5 py-0.5 rounded-full font-bold tracking-widest uppercase shadow-xs">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 dark:bg-emerald-600 animate-pulse"></span>
        MSWD PORTAL
      </span>
    </div>

    <div class="flex items-center gap-2.5">
      <div class="text-right leading-tight hidden sm:block">
        <p class="text-[10px] font-extrabold text-mswd-red dark:text-red-400 tracking-tight uppercase">Municipal Social Welfare</p>
        <p class="text-[8px] font-semibold text-slate-400 dark:text-slate-500 tracking-wider uppercase">& Development Office</p>
      </div>
      <div class="w-8 h-8 flex items-center justify-center shrink-0 overflow-hidden rounded-xl bg-white/80 dark:bg-slate-800/80 p-1 border border-slate-200/80 dark:border-slate-700/60 backdrop-blur-md">
        <?php if ($activeSecondary): ?>
          <img src="<?= htmlspecialchars($activeSecondary) ?>" alt="Secondary Logo" class="w-full h-full object-contain">
        <?php else: ?>
          <svg class="w-full h-full text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 7c-2 0-3.5 1.5-3.5 3.2 0 2.6 3.5 5 3.5 5s3.5-2.4 3.5-5c0-1.7-1.5-3.2-3.5-3.2z" fill="#830000"/></svg>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- GLASS HERO BANNER -->
  <section class="w-full max-w-5xl mx-auto my-2 shrink-0 relative z-10">
    <div class="glass-card rounded-2xl p-3.5 sm:p-4 shadow-sm overflow-hidden relative border border-white/80 dark:border-slate-800/80">
      <div class="relative z-10 flex items-center justify-between gap-3">
        <div>
          <span class="inline-block text-[9px] font-bold tracking-widest text-slate-500 dark:text-slate-400 uppercase">Welcome to MSWD Public Services</span>
          <h2 class="text-xs sm:text-sm font-black text-slate-900 dark:text-white tracking-tight">How can we assist you today?</h2>
        </div>
        <button onclick="openMapModal()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-900/5 dark:bg-white/10 hover:bg-slate-900/10 dark:hover:bg-white/20 text-slate-800 dark:text-white text-[11px] font-semibold transition-all border border-slate-900/10 dark:border-white/15 shrink-0 active:scale-95">
          <span>📍 Visit GAD Building</span>
        </button>
      </div>
    </div>
  </section>

  <!-- MAIN PROGRAM GRID -->
  <main class="w-full max-w-5xl mx-auto flex-1 flex flex-col justify-center min-h-0 relative z-10 my-auto">
    <div class="mb-2 flex items-center justify-between border-b border-slate-200/60 dark:border-slate-800/60 pb-1.5">
      <div>
        <h3 class="text-[10px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Service Catalog</h3>
      </div>
      <span class="text-[10px] font-medium text-slate-600 dark:text-slate-400 glass-card px-2.5 py-0.5 rounded-full shadow-xs">
        5 Active Services
      </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5">
      
      <!-- CARD 01: Persons with Disability -->
      <div onclick="openModal('Persons with Disability', 'Financial, medical, and mobility aid for Persons with Disabilities residing in San Juan, La Union.', { standard: ['Valid PWD ID', 'Medical Certificate', 'Barangay Certificate of Indigency', 'Proof of Residency'] }, 'pwd_login.php', 'pwd_form.php')" class="glass-card glass-card-hover rounded-2xl p-3.5 text-left flex flex-col justify-between group cursor-pointer transition-all duration-200 shadow-sm hover:-translate-y-0.5">
        <div>
          <div class="flex items-center justify-between w-full mb-2">
            <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:bg-mswd-red group-hover:text-white transition-all duration-200">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="4" r="2"/><path d="M19 13v-2a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v8"/><path d="M9 19h8a2 2 0 0 0 2-2v-4"/><path d="M5 11l4 2"/></svg>
            </div>
            <span class="text-[10px] font-mono font-black text-blue-600 dark:text-blue-400 bg-blue-50/80 dark:bg-blue-950/60 px-2 py-0.5 rounded-full">01</span>
          </div>
          <h3 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-mswd-red transition-colors">Persons with Disability</h3>
          <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">Mobility aid, medical support, and financial services.</p>
        </div>
        <div class="mt-2 pt-2 border-t border-slate-200/50 dark:border-slate-800/60 flex items-center justify-between text-[11px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-mswd-red transition-colors">
          <span>View Details</span><span class="group-hover:translate-x-1 transition-transform">→</span>
        </div>
      </div>

      <!-- CARD 02: Solo Parent Care -->
      <div onclick="openModal('Solo Parent Care', 'Comprehensive welfare support, educational aid, and emergency support for single parents in San Juan.', { standard: ['Solo Parent ID', 'Child Birth Certificate', 'Barangay Clearance', 'Certificate of Indigency'] }, 'solo_parent_login.php', 'solo_parent_form.php')" class="glass-card glass-card-hover rounded-2xl p-3.5 text-left flex flex-col justify-between group cursor-pointer transition-all duration-200 shadow-sm hover:-translate-y-0.5">
        <div>
          <div class="flex items-center justify-between w-full mb-2">
            <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:bg-mswd-red group-hover:text-white transition-all duration-200">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <span class="text-[10px] font-mono font-black text-emerald-600 dark:text-emerald-400 bg-emerald-50/80 dark:bg-emerald-950/60 px-2 py-0.5 rounded-full">02</span>
          </div>
          <h3 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-mswd-red transition-colors">Solo Parent Care</h3>
          <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">Educational aid, healthcare, and social benefits.</p>
        </div>
        <div class="mt-2 pt-2 border-t border-slate-200/50 dark:border-slate-800/60 flex items-center justify-between text-[11px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-mswd-red transition-colors">
          <span>View Details</span><span class="group-hover:translate-x-1 transition-transform">→</span>
        </div>
      </div>

      <!-- CARD 03: AICS Program -->
      <div onclick="openModal('Assistance in Crisis Situations (AICS)', 'Official Educational, Medical, and Burial assistance support.', {
        'Educational Assistance': [
          '1 Original and 1 Xerox Copy of Certificate of Attestation Certificate from the Barangay (Person to be Interviewed)',
          '2 Xerox Copies of School ID',
          '1 Original and 1 Xerox Copy of Enrollment Certificate',
          '2 Xerox Copies of Valid ID if not the student. 2 Xerox Copies of the ID of person being interviewed (if not the student).',
          '1 Original and Xerox Copy of Certificate of Grades not lower than 80'
        ],
        'Medical Assistance': [
          '1 Original and 1 Xerox Copy of Certificate of Attestation Certificate from the Barangay (Person to be Interviewed) if not an indigent, a certificate that includes that the person is in need of financial assistance.',
          '1 Original and 1 Xerox Copy of Medical Certificate',
          '2 Xerox Copies of prescription with Quotation/Statement of Account/Treatment Protocol, or Promissory Note',
          '2 Xerox Copies of Valid ID',
          '2 Xerox Copies of the ID of the person in need of medical assistance'
        ],
        'Burial Assistance': [
          '1 Original and 1 Xerox Copy of Certificate of Attestation Certificate from the Barangay (Person to be Interviewed) if not an indigent, a certificate that includes that the person is in need of financial assistance.',
          '2 Xerox Copies of Registered Death Certificate',
          '2 Xerox Copies of Funeral Contract / Promissory Note for the Burial',
          '2 Xerox Copies of Valid ID of Person to be Interviewed and the Beneficiary'
        ]
      }, 'aics_login.php', 'aics_form.php', true)" class="glass-card glass-card-hover rounded-2xl p-3.5 text-left flex flex-col justify-between group cursor-pointer transition-all duration-200 shadow-sm hover:-translate-y-0.5">
        <div>
          <div class="flex items-center justify-between w-full mb-2">
            <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center group-hover:bg-mswd-red group-hover:text-white transition-all duration-200">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M12 8v8"/><path d="M8 12h8"/></svg>
            </div>
            <span class="text-[10px] font-mono font-black text-rose-600 dark:text-rose-400 bg-rose-50/80 dark:bg-rose-950/60 px-2 py-0.5 rounded-full">03</span>
          </div>
          <h3 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-mswd-red transition-colors">AICS Program</h3>
          <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">Educational, Medical, and Burial official assistance.</p>
        </div>
        <div class="mt-2 pt-2 border-t border-slate-200/50 dark:border-slate-800/60 flex items-center justify-between text-[11px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-mswd-red transition-colors">
          <span>View Details</span><span class="group-hover:translate-x-1 transition-transform">→</span>
        </div>
      </div>

      <!-- CARD 04: Senior Citizen Care -->
      <div onclick="openModal('Senior Citizen Care', 'Health privileges, pension support, and senior care programs for residents aged 60 and above.', { standard: ['Senior Citizen OSCA ID', 'Barangay Residency Certificate', 'Proof of Age / Birth Certificate'] }, 'senior_login.php', 'senior_form.php')" class="glass-card glass-card-hover rounded-2xl p-3.5 text-left flex flex-col justify-between group cursor-pointer transition-all duration-200 shadow-sm hover:-translate-y-0.5">
        <div>
          <div class="flex items-center justify-between w-full mb-2">
            <div class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center group-hover:bg-mswd-red group-hover:text-white transition-all duration-200">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <span class="text-[10px] font-mono font-black text-amber-600 dark:text-amber-400 bg-amber-50/80 dark:bg-amber-950/60 px-2 py-0.5 rounded-full">04</span>
          </div>
          <h3 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-mswd-red transition-colors">Senior Citizen Care</h3>
          <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">Pension assistance, health privileges, and senior care.</p>
        </div>
        <div class="mt-2 pt-2 border-t border-slate-200/50 dark:border-slate-800/60 flex items-center justify-between text-[11px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-mswd-red transition-colors">
          <span>View Details</span><span class="group-hover:translate-x-1 transition-transform">→</span>
        </div>
      </div>

      <!-- CARD 05: Livelihood Aid -->
      <div onclick="openModal('Livelihood Assistance', 'Micro-enterprise seed capital grants, skills enhancement, and business starter kits for San Juan locals.', { standard: ['Project Proposal / Intent Form', 'Valid Government ID', 'Barangay Certificate of Indigency'] }, 'livelihood_login.php', 'livelihood_form.php')" class="glass-card glass-card-hover rounded-2xl p-3.5 text-left flex flex-col justify-between group cursor-pointer transition-all duration-200 shadow-sm hover:-translate-y-0.5 sm:col-span-2 lg:col-span-1">
        <div>
          <div class="flex items-center justify-between w-full mb-2">
            <div class="w-8 h-8 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center group-hover:bg-mswd-red group-hover:text-white transition-all duration-200">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
            <span class="text-[10px] font-mono font-black text-indigo-600 dark:text-indigo-400 bg-indigo-50/80 dark:bg-indigo-950/60 px-2 py-0.5 rounded-full">05</span>
          </div>
          <h3 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-mswd-red transition-colors">Livelihood Aid</h3>
          <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">Micro-business grants and starter kits.</p>
        </div>
        <div class="mt-2 pt-2 border-t border-slate-200/50 dark:border-slate-800/60 flex items-center justify-between text-[11px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-mswd-red transition-colors">
          <span>View Details</span><span class="group-hover:translate-x-1 transition-transform">→</span>
        </div>
      </div>

    </div>
  </main>

  <!-- FOOTER -->
  <footer class="w-full max-w-5xl mx-auto pt-2 border-t border-slate-200/60 dark:border-slate-800/60 shrink-0 flex items-center justify-between gap-2 relative z-10">
    <div class="flex items-center gap-2">
      <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-xl glass-card text-[10px] font-semibold text-slate-600 dark:text-slate-400 shadow-xs">
        <span id="status-indicator" class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
        <span id="mode-text">Member Access</span>
      </div>
    </div>
    <button id="guest-btn" onclick="toggleGuestMode()" class="bg-slate-900/90 dark:bg-slate-100/90 hover:bg-slate-900 dark:hover:bg-white text-white dark:text-slate-900 text-[11px] font-bold px-4 py-1.5 rounded-xl transition-all active:scale-95 flex items-center justify-center shadow-xs">
      <span id="guest-btn-label">Continue as Guest</span>
    </button>
  </footer>

  <!-- FIXED FLOATING DARK MODE BUTTON -->
  <button onclick="toggleTheme()" aria-label="Toggle Theme" class="fixed bottom-4 right-4 z-40 p-2.5 rounded-xl glass-card hover:scale-105 active:scale-95 text-slate-700 dark:text-slate-200 transition-all shadow-lg group">
    <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 text-amber-500 group-hover:rotate-45 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"/></svg>
    <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4 text-indigo-400 group-hover:-rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
  </button>

  <!-- PROGRAM MODAL -->
  <div id="modal-overlay" class="fixed inset-0 bg-slate-950/40 dark:bg-slate-950/70 backdrop-blur-xl z-50 opacity-0 pointer-events-none transition-all duration-200 flex items-center justify-center p-4">
    <div id="modal-box" class="glass-card w-full max-w-lg rounded-2xl p-5 shadow-2xl transform scale-95 transition-all duration-200 max-h-[85vh] overflow-y-auto border border-white/80 dark:border-slate-800">
      <div class="flex items-center justify-between border-b border-slate-200/50 dark:border-slate-800 pb-2 mb-3">
        <div>
          <span class="text-[9px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Program Details</span>
          <h2 id="modal-title" class="text-sm font-extrabold text-slate-900 dark:text-slate-100 uppercase">Title</h2>
        </div>
        <button onclick="closeModal()" class="w-7 h-7 rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 font-bold flex items-center justify-center text-xs transition">✕</button>
      </div>
      
      <p id="modal-desc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-3"></p>
      
      <div id="modal-list-container" class="mb-4 space-y-2"></div>

      <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-200/50 dark:border-slate-800">
        <button onclick="closeModal()" class="bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold px-3 py-2 rounded-xl transition">Close</button>
        <button id="action-href-btn" onclick="handleActionClick()" class="bg-mswd-red hover:bg-mswd-hoverRed text-white text-xs font-extrabold px-4 py-2 rounded-xl transition active:scale-95 text-center shadow-md">
          LOGIN NOW
        </button>
      </div>
    </div>
  </div>

  <!-- AICS TYPE SELECTION MODAL -->
  <div id="aics-selection-overlay" class="fixed inset-0 bg-slate-950/40 dark:bg-slate-950/70 backdrop-blur-xl z-50 opacity-0 pointer-events-none transition-all duration-200 flex items-center justify-center p-4">
    <div id="aics-selection-box" class="glass-card w-full max-w-md rounded-2xl p-5 shadow-2xl transform scale-95 transition-all duration-200 border border-white/80 dark:border-slate-800">
      <div class="flex items-center justify-between border-b border-slate-200/50 dark:border-slate-800 pb-2 mb-3">
        <div>
          <span class="text-[9px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-widest">AICS Application</span>
          <h2 class="text-sm font-extrabold text-slate-900 dark:text-slate-100 uppercase">Select Assistance Type</h2>
        </div>
        <button onclick="closeAicsSelectionModal()" class="w-7 h-7 rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 font-bold flex items-center justify-center text-xs transition">✕</button>
      </div>

      <p class="text-xs text-slate-600 dark:text-slate-400 mb-3">Please choose the specific assistance form you would like to proceed with:</p>

      <div class="space-y-2">
        <a href="aics/medical-assistance-form.php" class="flex items-center justify-between p-3 rounded-xl bg-white/50 dark:bg-slate-800/50 hover:bg-mswd-red dark:hover:bg-mswd-red hover:text-white dark:hover:text-white border border-slate-200/60 dark:border-slate-700/60 text-slate-800 dark:text-slate-200 font-bold text-xs transition group shadow-xs">
          <span>Medical Assistance</span>
          <span class="group-hover:translate-x-1 transition-transform">→</span>
        </a>
        <a href="burial_form.php" class="flex items-center justify-between p-3 rounded-xl bg-white/50 dark:bg-slate-800/50 hover:bg-mswd-red dark:hover:bg-mswd-red hover:text-white dark:hover:text-white border border-slate-200/60 dark:border-slate-700/60 text-slate-800 dark:text-slate-200 font-bold text-xs transition group shadow-xs">
          <span>Burial Assistance</span>
          <span class="group-hover:translate-x-1 transition-transform">→</span>
        </a>
        <a href="educational_form.php" class="flex items-center justify-between p-3 rounded-xl bg-white/50 dark:bg-slate-800/50 hover:bg-mswd-red dark:hover:bg-mswd-red hover:text-white dark:hover:text-white border border-slate-200/60 dark:border-slate-700/60 text-slate-800 dark:text-slate-200 font-bold text-xs transition group shadow-xs">
          <span>Educational Assistance</span>
          <span class="group-hover:translate-x-1 transition-transform">→</span>
        </a>
      </div>
    </div>
  </div>

  <!-- MAP MODAL -->
  <div id="map-modal-overlay" class="fixed inset-0 bg-slate-950/40 dark:bg-slate-950/70 backdrop-blur-xl z-50 opacity-0 pointer-events-none transition-all duration-200 flex items-center justify-center p-4">
    <div id="map-modal-box" class="glass-card w-full max-w-2xl rounded-2xl p-5 shadow-2xl transform scale-95 transition-all duration-200 border border-white/80 dark:border-slate-800">
      <div class="flex items-center justify-between border-b border-slate-200/50 dark:border-slate-800 pb-2 mb-3">
        <div>
          <span class="text-[9px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Office Location</span>
          <h2 class="text-sm font-extrabold text-slate-900 dark:text-slate-100 uppercase">GAD Building - San Juan, La Union</h2>
        </div>
        <button onclick="closeMapModal()" class="w-7 h-7 rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 font-bold flex items-center justify-center text-xs transition">✕</button>
      </div>
      <div class="w-full h-60 rounded-xl overflow-hidden border border-slate-200/60 dark:border-slate-800/80 mb-3 shadow-xs">
        <iframe class="w-full h-full" src="https://maps.google.com/maps?q=GAD%20Building%20San%20Juan%20La%20Union&t=&z=16&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
      </div>
      <div class="flex items-center justify-between">
        <p class="text-xs text-slate-600 dark:text-slate-400">📍 Gender and Development (GAD) Building, Municipal Hall Compound</p>
        <a href="https://maps.google.com/?q=GAD+Building+San+Juan+La+Union" target="_blank" class="bg-slate-900/90 dark:bg-slate-100/90 hover:bg-slate-900 dark:hover:bg-white text-white dark:text-slate-900 text-xs font-bold px-3 py-2 rounded-xl transition shadow-xs">Get Directions ↗</a>
      </div>
    </div>
  </div>

  <!-- JAVASCRIPT -->
  <script>
    // Theme Toggle Functionality
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');

    function updateThemeIcons() {
      if (document.documentElement.classList.contains('dark')) {
        themeToggleLightIcon.classList.remove('hidden');
        themeToggleDarkIcon.classList.add('hidden');
      } else {
        themeToggleLightIcon.classList.add('hidden');
        themeToggleDarkIcon.classList.remove('hidden');
      }
    }

    function toggleTheme() {
      if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
      } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      }
      updateThemeIcons();
    }

    updateThemeIcons();

    // Modal & App Logic
    let isGuestMode = false;
    let activeCardLoginUrl = '#';
    let activeCardGuestUrl = '#';
    let isAicsCard = false;
    
    function toggleGuestMode(){
      isGuestMode = !isGuestMode;
      document.getElementById('mode-text').innerText = isGuestMode ? 'Guest Access' : 'Member Access';
      document.getElementById('guest-btn-label').innerText = isGuestMode ? 'Switch to Member Access' : 'Continue as Guest';
      document.getElementById('status-indicator').className = 'w-1.5 h-1.5 rounded-full ' + (isGuestMode ? 'bg-amber-500 animate-pulse' : 'bg-emerald-500');
      updateActionButton();
    }
    
    function openModal(title, desc, reqs, loginUrl, guestUrl, isAics = false){
      document.getElementById('modal-title').innerText = title;
      document.getElementById('modal-desc').innerText = desc;
      
      activeCardLoginUrl = loginUrl;
      activeCardGuestUrl = guestUrl;
      isAicsCard = isAics;
      
      const container = document.getElementById('modal-list-container');
      container.innerHTML = '';
      
      if(reqs.standard){
        container.innerHTML = `<div class="bg-slate-100/60 dark:bg-slate-800/40 p-3 rounded-xl border border-slate-200/60 dark:border-slate-800/60"><h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-1 shadow-none">Required Documents</h4><ul class="text-xs text-slate-600 dark:text-slate-400 space-y-1 list-disc pl-4">${reqs.standard.map(r=>`<li>${r}</li>`).join('')}</ul></div>`;
      } else {
        Object.keys(reqs).forEach(k => {
          container.innerHTML += `<div class="bg-slate-100/60 dark:bg-slate-800/40 p-3 rounded-xl border border-slate-200/60 dark:border-slate-800/60 mb-1.5"><h4 class="text-xs font-bold text-mswd-red uppercase tracking-wider mb-1">${k}</h4><ul class="text-xs text-slate-600 dark:text-slate-400 space-y-1 list-disc pl-4">${reqs[k].map(r=>`<li>${r}</li>`).join('')}</ul></div>`;
        });
      }
      
      updateActionButton();
      toggleVisibility('modal-overlay', 'modal-box', true);
    }
    
    function updateActionButton(){
      const actionBtn = document.getElementById('action-href-btn');
      if(isGuestMode){
        actionBtn.innerText = 'PROCEED TO FORM';
      } else {
        actionBtn.innerText = 'LOGIN NOW';
      }
    }

    function handleActionClick(){
      if(isGuestMode){
        if(isAicsCard){
          closeModal();
          openAicsSelectionModal();
        } else {
          window.location.href = activeCardGuestUrl;
        }
      } else {
        window.location.href = activeCardLoginUrl;
      }
    }

    function openAicsSelectionModal(){ toggleVisibility('aics-selection-overlay', 'aics-selection-box', true); }
    function closeAicsSelectionModal(){ toggleVisibility('aics-selection-overlay', 'aics-selection-box', false); }
    
    function closeModal(){ toggleVisibility('modal-overlay', 'modal-box', false); }
    function openMapModal(){ toggleVisibility('map-modal-overlay', 'map-modal-box', true); }
    function closeMapModal(){ toggleVisibility('map-modal-overlay', 'map-modal-box', false); }
    
    function toggleVisibility(overlayId, boxId, show){
      const overlay = document.getElementById(overlayId);
      const box = document.getElementById(boxId);
      if(show){
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-95');
        box.classList.add('scale-100');
      } else {
        overlay.classList.add('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-100');
        box.classList.add('scale-95');
      }
    }
  </script>
</body>
</html>