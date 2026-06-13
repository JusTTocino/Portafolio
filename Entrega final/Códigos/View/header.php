<style>
.login-header {
    width: 100%;
    background: #490000;
    padding: 14px 24px;
    display: flex;
    align-items: center;
    gap: 14px;
    position: fixed;
    top: 0;
    left: 0;
    box-sizing: border-box;
    z-index: 100;
}
.logo-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    overflow: hidden;
  
    flex-shrink: 0;
}
.logo-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.header-titulo {
    color: white;
    font-weight: 700;
    font-size: 15px;
}
.header-sub {
    color: white;
    font-size: 12px;
}
</style>

<div class="login-header">
    <div class="logo-circle">
        <img src="/img/logo.png" alt="CBTIS">
    </div>
    <div>
        <div class="header-titulo">CBTIS No. 37</div>
        <div class="header-sub">Gestor de Justificantes</div>
    </div>
</div>