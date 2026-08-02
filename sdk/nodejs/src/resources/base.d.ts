// Type declarations for the resource base class.

export declare class Resource {
  constructor(client: any);
  protected _client: any;
  protected _call(
    method: string,
    path: string,
    options?: { query?: Record<string, any>; body?: any; authenticated?: boolean; raw?: boolean },
  ): Promise<any>;
  protected _path(template: string, params?: Record<string, string | number>): string;
}
