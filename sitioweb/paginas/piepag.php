<footer class="rappi-footer-red">
  <div class="container-fluid">
    <div class="footer-content">
      <span class="footer-text">derechos reservados</span>
      <div class="social-icons-footer">
        <a href="#" class="social-icon-link" title="Facebook">
          <img src="imagenes/facebook-icon.png" alt="Facebook" class="social-icon-img">
        </a>
        <a href="#" class="social-icon-link" title="Instagram">
          <img src="imagenes/instagram-icon.png" alt="Instagram" class="social-icon-img">
        </a>
        <a href="#" class="social-icon-link" title="Twitter">
          <img src="imagenes/twitter-icon.png" alt="Twitter" class="social-icon-img">
        </a>
      </div>
    </div>
  </div>
</footer>

<style>
  .rappi-footer-red {
    background: linear-gradient(90deg, #ff7b6b 0%, #ff6b5e 50%, #ff8a7a 100%);
    padding: 12px 0;
    position: relative;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
  }
  
  .footer-text {
    color: white;
    font-size: 0.9rem;
    font-weight: 400;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
  }
  
  .social-icons-footer {
    display: flex;
    gap: 12px;
    align-items: center;
  }
  
  .social-icon-link {
    display: inline-block;
    width: 32px;
    height: 32px;
    background-color: white;
    border-radius: 6px;
    padding: 4px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }
  
  .social-icon-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
  }
  
  .social-icon-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
  
  /* Responsive */
  @media (max-width: 576px) {
    .footer-content {
      flex-direction: column;
      gap: 10px;
      text-align: center;
    }
    
    .footer-text {
      font-size: 0.8rem;
    }
    
    .social-icons-footer {
      gap: 10px;
    }
    
    .social-icon-link {
      width: 28px;
      height: 28px;
    }
  }
</style>