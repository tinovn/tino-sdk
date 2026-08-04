# Tino UserAPI documentation

| Document | What it covers |
| --- | --- |
| [getting-started.md](getting-started.md) | Base URL, the three login flows (OTP, password, SSO), token lifecycle, public endpoints |
| [conventions.md](conventions.md) | Error envelope, pagination, filters, data types, binary responses, unsafe GETs |
| [api-contract/](api-contract/README.md) | Every endpoint: parameters, request body, response sample, SDK call |

## Quick orientation

The API is the customer-facing surface of Tino's HostBill deployment. One token = one
client account. There are 257 operations across 18 resource groups:

| Group | What lives there |
| --- | --- |
| `auth` | login (password / OTP / SSO), signup, tokens, password reset |
| `account` | profile, settings, contacts, notifications, activity log, downloads |
| `billing` | balance, invoices, estimates, credit, payment links and methods |
| `support` | tickets, departments, news, knowledgebase |
| `domains` | registration, nameservers, contacts, DNSSEC, EPP, renewals, WHOIS |
| `dns` | zones and records on a DNS service |
| `services` | hosting/VPS lifecycle, upgrades, billing cycle, IPs, email accounts |
| `cpanel` | cPanel autologin, statistics, password and domain changes |
| `vms` | cloud instances: power, rebuild, backups, snapshots, interfaces |
| `cart` | catalogue, product options, quotes, orders |
| `certificates` | SSL products and issued certificates |
| `affiliate` | commissions, payouts, vouchers, campaigns |
| `security` | SSH keys and IP access rules |
| `phone` | Phone-number verification (prove SIM ownership over ZNS) |
| `location` | countries, states, cities (Vietnam post-2025 administrative units) |
| `languages` | language list and translation files |
| `ekyc` | domain documents, OCR, face verification, national id checks |
| `tinosite` | managed WordPress: themes, plugins, users, SSL, backups |

## How this documentation was produced

The contract reconciles three views of the API — its formal specification, the way
Tino's own client calls it in production, and what the live service answers. Where they
disagreed, the live service won.

195 operations were called against `https://api.tino.vn` with a real account; their
responses are captured, redacted and embedded as samples. Endpoints marked *spec only* need data the sandbox account does not have — a TinoSite
service, a verified eKYC identity, an affiliate plan, a second contact — or they end the
session, so they could not be exercised.

Operations carry a `verified` field: `live` (called, response captured) or `spec`
(documented, not called). The index lists it per endpoint.
