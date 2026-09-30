# Security Policy

## Reporting Vulnerabilities

If you identify a security issue within `gm-code-lab`, please report it privately to the security team.

## Security Practices & Architecture Controls

1. **Environment Secret Protection**:
   - Production keys (`APP_KEY`, database passwords, Razorpay credentials) must be configured via `.env` and excluded from version control.

2. **Session & CSRF Verification**:
   - All forms and dynamic endpoints verify CSRF tokens.
   - Encrypted HTTP-only cookies prevent cookie tampering.

3. **Data Access & Authorization**:
   - Strict Eloquent ORM parameterization protects against SQL injection.
   - Access control policies regulate administrative permissions.
