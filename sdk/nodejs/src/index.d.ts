// Type declarations for the Tino UserAPI Node.js SDK.

import type { AccountResource } from './resources/account.js';
import type { AffiliateResource } from './resources/affiliate.js';
import type { AuthResource } from './resources/auth.js';
import type { BackorderResource } from './resources/backorder.js';
import type { BillingResource } from './resources/billing.js';
import type { CartResource } from './resources/cart.js';
import type { CertificatesResource } from './resources/certificates.js';
import type { CpanelResource } from './resources/cpanel.js';
import type { DnsResource } from './resources/dns.js';
import type { DomainsResource } from './resources/domains.js';
import type { EkycResource } from './resources/ekyc.js';
import type { LanguagesResource } from './resources/languages.js';
import type { LocationResource } from './resources/location.js';
import type { PhoneResource } from './resources/phone.js';
import type { SecurityResource } from './resources/security.js';
import type { ServicesResource } from './resources/services.js';
import type { SupportResource } from './resources/support.js';
import type { TinositeResource } from './resources/tinosite.js';
import type { VmsResource } from './resources/vms.js';

export declare const DEFAULT_BASE_URL: string;
export declare const SDK_VERSION: string;

export interface TinoClientOptions {
  /** Defaults to https://api.tino.vn */
  baseUrl?: string;
  /** Bearer access token. */
  token?: string | null;
  /** Refresh token used to renew the access token automatically. */
  refreshToken?: string | null;
  /** Request timeout in milliseconds. Defaults to 60000. */
  timeout?: number;
  /** Renew the access token once on `unauthorized` / `token_expired`. Defaults to true. */
  autoRefresh?: boolean;
  userAgent?: string;
  defaultHeaders?: Record<string, string>;
  /** Called whenever a new access token is stored — persist it here. */
  onTokenRefresh?: (token: string, refreshToken: string) => void;
  /** Replaces the built-in fetch transport (custom retries, proxy, tests). */
  transport?: (
    method: string,
    url: string,
    options: { headers: Record<string, string>; body?: any; timeout?: number },
  ) => Promise<TinoRawResponse>;
}

export interface TinoRawResponse {
  status: number;
  headers: Headers;
  /** Undecoded bytes — use this for PDFs, certificates and other binary payloads. */
  content: Buffer;
  text: string;
  json: any;
}

export interface TinoLoginResult {
  token?: string;
  refresh?: string;
  client?: Record<string, any>;
  currency?: Record<string, any>;
  verify?: Record<string, any>;
  update_required?: boolean;
  [key: string]: any;
}

export declare class TinoClient {
  constructor(options?: TinoClientOptions);

  baseUrl: string;
  token: string | null;
  refreshToken: string | null;

  setTokens(token: string | null, refreshToken?: string | null): void;
  login(username: string, password: string, remember?: boolean): Promise<TinoLoginResult>;
  requestLoginOtp(email: string): Promise<{ status: string; message: string; via?: string }>;
  verifyLoginOtp(email: string, otp: string): Promise<TinoLoginResult>;
  refreshAccessToken(): Promise<string | null>;
  logout(): Promise<any>;

  request(
    method: string,
    path: string,
    options?: {
      query?: Record<string, any>;
      body?: any;
      authenticated?: boolean;
      allowRefresh?: boolean;
      raw?: boolean;
    },
  ): Promise<any>;

  readonly account: AccountResource;
  readonly affiliate: AffiliateResource;
  readonly auth: AuthResource;
  readonly backorder: BackorderResource;
  readonly billing: BillingResource;
  readonly cart: CartResource;
  readonly certificates: CertificatesResource;
  readonly cpanel: CpanelResource;
  readonly dns: DnsResource;
  readonly domains: DomainsResource;
  readonly ekyc: EkycResource;
  readonly languages: LanguagesResource;
  readonly location: LocationResource;
  readonly phone: PhoneResource;
  readonly security: SecurityResource;
  readonly services: ServicesResource;
  readonly support: SupportResource;
  readonly tinosite: TinositeResource;
  readonly vms: VmsResource;
}

export declare class TinoError extends Error {}
export declare class TinoTransportError extends TinoError {}
export declare class TinoApiError extends TinoError {
  status: number;
  errors: string[];
  method: string;
  path: string;
  body: any;
}
export declare class TinoAuthError extends TinoApiError {}
export declare class TinoNotFoundError extends TinoApiError {}
export declare class TinoRateLimitError extends TinoApiError {}
export declare class TinoValidationError extends TinoApiError {}

export declare function encodeQuery(params: Record<string, any>): string;
export declare function buildUrl(baseUrl: string, path: string, query?: Record<string, any>): string;
export { Resource } from './resources/base.js';
