# Tino UserAPI — endpoint reference

Base URL: `https://api.tino.vn`

263 operations across 19 resource groups. 134 were called against the live API and carry a captured response sample; the rest are documented from the API specification and marked *spec only*.

See [../getting-started.md](../getting-started.md) for authentication and [../conventions.md](../conventions.md) for pagination, error handling and encoding rules.

## Chapters

| Chapter | Group | Operations |
| --- | --- | --- |
| [Authentication](01-auth.md) | `auth` | 14 |
| [Client area & account (part 1/3)](02-account-part-1.md) | `account` | 13 |
| [Client area & account (part 2/3)](02-account-part-2.md) | `account` | 11 |
| [Client area & account (part 3/3)](02-account-part-3.md) | `account` | 5 |
| [Billing, invoices & payments (part 1/2)](03-billing-part-1.md) | `billing` | 16 |
| [Billing, invoices & payments (part 2/2)](03-billing-part-2.md) | `billing` | 5 |
| [Support tickets, news & knowledgebase](04-support.md) | `support` | 13 |
| [Domain names (part 1/3)](05-domains-part-1.md) | `domains` | 12 |
| [Domain names (part 2/3)](05-domains-part-2.md) | `domains` | 16 |
| [Domain names (part 3/3)](05-domains-part-3.md) | `domains` | 3 |
| [DNS zones & records](06-dns.md) | `dns` | 12 |
| [Services (hosting, VPS, ...) (part 1/2)](07-services-part-1.md) | `services` | 15 |
| [Services (hosting, VPS, ...) (part 2/2)](07-services-part-2.md) | `services` | 11 |
| [cPanel service actions](08-cpanel.md) | `cpanel` | 7 |
| [Cloud instances / virtual machines (part 1/3)](09-vms-part-1.md) | `vms` | 15 |
| [Cloud instances / virtual machines (part 2/3)](09-vms-part-2.md) | `vms` | 15 |
| [Cloud instances / virtual machines (part 3/3)](09-vms-part-3.md) | `vms` | 5 |
| [Catalogue, cart & orders](10-cart.md) | `cart` | 10 |
| [SSL certificates](11-certificates.md) | `certificates` | 6 |
| [Affiliate programme](12-affiliate.md) | `affiliate` | 12 |
| [Account security (SSH keys, IP access)](13-security.md) | `security` | 5 |
| [Countries, states & cities](14-location.md) | `location` | 8 |
| [Languages & translations](15-languages.md) | `languages` | 3 |
| [Domain documents & eKYC](16-ekyc.md) | `ekyc` | 14 |
| [TinoSite (managed WordPress)](17-tinosite.md) | `tinosite` | 10 |
| [TinoMail](18-tinomail.md) | `tinomail` | 2 |
| [Proxmox2 usage monitor](19-usage-monitor.md) | `usageMonitor` | 5 |

## All endpoints

| Method | Path | SDK method | Auth | Verified |
| --- | --- | --- | --- | --- |
| `GET` | `/addfunds` | `billing.getAddFundsInfo` | Bearer | live |
| `POST` | `/addfunds` | `billing.addFundsLegacy` | Bearer | spec |
| `POST` | `/affiliate/active` | `affiliate.activate` | Bearer | spec |
| `POST` | `/affiliate/addvoucher` | `affiliate.addVoucherLegacy` | Bearer | spec |
| `DELETE` | `/affiliate/removevoucher` | `affiliate.removeVoucherLegacy` | Bearer | spec |
| `POST` | `/affiliates/addvoucher` | `affiliate.addVoucher` | Bearer | spec |
| `GET` | `/affiliates/campaigns` | `affiliate.listCampaigns` | Bearer | live |
| `GET` | `/affiliates/commissionplans` | `affiliate.listCommissionPlans` | Bearer | live |
| `GET` | `/affiliates/commissions` | `affiliate.listCommissions` | Bearer | live |
| `GET` | `/affiliates/payouts` | `affiliate.listPayouts` | Bearer | live |
| `GET` | `/affiliates/plans/{id}` | `affiliate.getCommissionPlan` | Bearer | live |
| `GET` | `/affiliates/summary` | `affiliate.getSummary` | Bearer | live |
| `GET` | `/affiliates/vouchers` | `affiliate.listVouchers` | Bearer | live |
| `DELETE` | `/affiliates/vouchers/{id}/remove` | `affiliate.removeVoucher` | Bearer | spec |
| `GET` | `/balance` | `billing.getBalance` | Bearer | live |
| `POST` | `/billing/addfunds` | `billing.addFunds` | Bearer | spec |
| `GET` | `/billing/creditlogs` | `billing.getCreditLogs` | Bearer | live |
| `POST` | `/billing/creditvoucher` | `billing.redeemCreditVoucher` | Bearer | spec |
| `GET` | `/billing/{invoice_id}/pay/{gateway_id}` | `billing.getPaymentLink` | Bearer | live |
| `GET` | `/cart/coupon` | `cart.listCoupons` | public | live |
| `GET` | `/cart/domain/tlds` | `cart.listDomainTlds` | public | live |
| `GET` | `/categories` | `cart.listCategoryTree` | public | live |
| `GET` | `/category` | `cart.listCategories` | Bearer | live |
| `GET` | `/category/{category_id}/product` | `cart.listProducts` | Bearer | live |
| `GET` | `/certificate/order` | `certificates.listProducts` | Bearer | live |
| `POST` | `/certificate/order` | `certificates.order` | Bearer | spec |
| `GET` | `/certificate/order/{product_id}/software` | `certificates.listServerSoftware` | Bearer | live |
| `GET` | `/certificate/{id}` | `certificates.get` | Bearer | spec |
| `GET` | `/certificate/{service_id}/crt` | `certificates.download` | Bearer | spec |
| `GET` | `/certificates` | `certificates.list` | Bearer | live |
| `GET` | `/changeowner` | `account.listOwnerTransfers` | Bearer | live |
| `POST` | `/checkemail` | `auth.checkEmail` | public | live |
| `GET` | `/clientarea` | `account.getSummary` | Bearer | live |
| `GET` | `/clientarea/businessinfo` | `account.getBusinessInfo` | Bearer | live |
| `GET` | `/clientarea/downloadprofile` | `account.downloadBusinessProfile` | Bearer | live |
| `GET` | `/clientarea/histories` | `account.listHistories` | Bearer | live |
| `GET` | `/clientarea/history/emails` | `account.listEmails` | Bearer | live |
| `GET` | `/clientarea/history/emails/{id}` | `account.getEmail` | Bearer | live |
| `GET` | `/clientarea/nav/service` | `account.getServiceNav` | Bearer | live |
| `POST` | `/clientarea/search/` | `account.search` | Bearer | live |
| `GET` | `/clientarea/settings` | `account.getSettings` | Bearer | live |
| `POST` | `/clientarea/settings` | `account.updateSettings` | Bearer | spec |
| `GET` | `/clientarea/statuses` | `account.listStatuses` | Bearer | live |
| `POST` | `/clientarea/uploadprofile` | `account.uploadSignedBusinessProfile` | Bearer | spec |
| `GET` | `/contact` | `account.listContacts` | Bearer | live |
| `POST` | `/contact` | `account.createContact` | Bearer | spec |
| `GET` | `/contact/privileges` | `account.getContactPrivileges` | Bearer | live |
| `GET` | `/contact/{id}` | `account.getContact` | Bearer | live |
| `PUT` | `/contact/{id}` | `account.updateContact` | Bearer | spec |
| `GET` | `/contacts` | `account.listContactsLegacy` | Bearer | live |
| `GET` | `/currencies` | `billing.getCurrencies` | public | live |
| `GET` | `/details` | `account.getDetails` | Bearer | live |
| `PUT` | `/details` | `account.updateDetails` | Bearer | spec |
| `GET` | `/dns` | `dns.listZonesAll` | Bearer | live |
| `GET` | `/dns/templates` | `dns.listTemplates` | Bearer | live |
| `GET` | `/domain` | `domains.listLegacy` | Bearer | live |
| `POST` | `/domain/documents/companyprofile` | `ekyc.uploadCompanyProfile` | Bearer | spec |
| `POST` | `/domain/documents/signed` | `ekyc.signDocument` | Bearer | spec |
| `GET` | `/domain/documents/view/{token}` | `ekyc.viewSignableDocument` | Bearer | spec |
| `POST` | `/domain/lookup` | `domains.lookup` | public | live |
| `GET` | `/domain/name/{name}` | `domains.getByName` | Bearer | live |
| `POST` | `/domain/order` | `domains.order` | Bearer | spec |
| `GET` | `/domain/order/{id}/form` | `domains.getTldForm` | Bearer | live |
| `POST` | `/domain/suggest` | `domains.suggest` | public | live |
| `POST` | `/domain/vnnic/promocode` | `ekyc.getVnnicPromoCode` | Bearer | spec |
| `GET` | `/domain/{id}` | `domains.get` | Bearer | live |
| `GET` | `/domain/{id}/autorenew` | `domains.getAutoRenew` | Bearer | live |
| `PUT` | `/domain/{id}/autorenew` | `domains.updateAutoRenew` | Bearer | spec |
| `GET` | `/domain/{id}/contact` | `domains.getContacts` | Bearer | live |
| `PUT` | `/domain/{id}/contact` | `domains.updateContacts` | Bearer | spec |
| `GET` | `/domain/{id}/dnssec` | `domains.listDnssecKeys` | Bearer | live |
| `PUT` | `/domain/{id}/dnssec` | `domains.addDnssecKey` | Bearer | spec |
| `GET` | `/domain/{id}/dnssec/flags` | `domains.getDnssecFlags` | Bearer | live |
| `DELETE` | `/domain/{id}/dnssec/{key}` | `domains.removeDnssecKey` | Bearer | spec |
| `GET` | `/domain/{id}/documents` | `ekyc.listDomainDocuments` | Bearer | live |
| `GET` | `/domain/{id}/documents/{document_id}/download` | `ekyc.downloadDomainDocument` | Bearer | spec |
| `POST` | `/domain/{id}/documents/{document_id}/upload` | `ekyc.uploadDomainDocument` | Bearer | spec |
| `GET` | `/domain/{id}/emforwarding` | `domains.getEmailForwarding` | Bearer | live |
| `PUT` | `/domain/{id}/emforwarding` | `domains.updateEmailForwarding` | Bearer | spec |
| `GET` | `/domain/{id}/epp` | `domains.getEppCode` | Bearer | live |
| `PUT` | `/domain/{id}/forwarding` | `domains.updateForwarding` | Bearer | spec |
| `PUT` | `/domain/{id}/idprotection` | `domains.updateIdProtection` | Bearer | spec |
| `GET` | `/domain/{id}/invoices` | `domains.listInvoices` | Bearer | live |
| `GET` | `/domain/{id}/ns` | `domains.getNameservers` | Bearer | live |
| `PUT` | `/domain/{id}/ns` | `domains.updateNameservers` | Bearer | spec |
| `GET` | `/domain/{id}/reg` | `domains.getRegisteredNameservers` | Bearer | live |
| `POST` | `/domain/{id}/reg` | `domains.registerNameserver` | Bearer | spec |
| `GET` | `/domain/{id}/reglock` | `domains.getRegistrarLock` | Bearer | live |
| `PUT` | `/domain/{id}/reglock` | `domains.updateRegistrarLock` | Bearer | spec |
| `POST` | `/domain/{id}/renew` | `domains.renew` | Bearer | spec |
| `GET` | `/domain/{id}/sync` | `domains.sync` | Bearer | live |
| `GET` | `/domains` | `domains.list` | Bearer | live |
| `GET` | `/download/{id}` | `account.downloadFile` | Bearer | spec |
| `GET` | `/downloads` | `account.listDownloads` | Bearer | live |
| `POST` | `/ekyc/check-status-url-ekyc` | `ekyc.checkUrlStatus` | Bearer | spec |
| `POST` | `/ekyc/checkid` | `ekyc.checkNationalId` | Bearer | live |
| `POST` | `/ekyc/exists` | `ekyc.exists` | Bearer | live |
| `POST` | `/ekyc/faceid/verification` | `ekyc.faceIdVerification` | Bearer | spec |
| `GET` | `/ekyc/households` | `ekyc.getHousehold` | Bearer | live |
| `POST` | `/ekyc/households` | `ekyc.checkHousehold` | Bearer | spec |
| `POST` | `/ekyc/ocr/recognition` | `ekyc.ocrRecognition` | Bearer | spec |
| `GET` | `/estimate/{id}/pdf` | `billing.getEstimatePdf` | Bearer | spec |
| `GET` | `/estimates` | `billing.listEstimates` | Bearer | live |
| `GET` | `/estimates/{id}` | `billing.getEstimate` | Bearer | spec |
| `GET` | `/invoice` | `billing.listInvoicesLegacy` | Bearer | live |
| `DELETE` | `/invoice/{id}` | `billing.deleteInvoice` | Bearer | spec |
| `GET` | `/invoice/{id}` | `billing.getInvoiceDetails` | Bearer | live |
| `POST` | `/invoice/{id}/credit` | `billing.applyCredit` | Bearer | spec |
| `GET` | `/invoice/{id}/pdf` | `billing.getInvoicePdf` | Bearer | live |
| `GET` | `/invoices` | `billing.listInvoices` | Bearer | live |
| `GET` | `/invoices/due` | `billing.listInvoicesDue` | Bearer | live |
| `POST` | `/invoices/payall` | `billing.payAllInvoices` | Bearer | spec |
| `GET` | `/knowledgebase` | `support.listKbCategories` | Bearer | live |
| `GET` | `/knowledgebase/article/{article_id}` | `support.getKbArticle` | Bearer | live |
| `GET` | `/knowledgebase/{category_id}` | `support.getKbCategory` | Bearer | live |
| `GET` | `/languages` | `languages.list` | public | live |
| `GET` | `/languages/file/{langname}` | `languages.getFile` | public | live |
| `GET` | `/languages/translate` | `languages.getBillingCycleLabels` | public | live |
| `GET` | `/location/citys` | `location.listAllCities` | public | live |
| `GET` | `/location/countries` | `location.listCountries` | public | live |
| `GET` | `/location/state/city-v2/{name}` | `location.getCityByStateNameV2` | Bearer | spec |
| `GET` | `/location/state/city/{name}` | `location.listCitiesByStateName` | public | live |
| `GET` | `/location/state/{id}/city` | `location.listCitiesByStateId` | public | live |
| `GET` | `/location/state/{id}/city-v2` | `location.listCitiesByStateIdV2` | public | live |
| `GET` | `/location/{code}/state` | `location.listStates` | public | live |
| `GET` | `/location/{code}/state-v2` | `location.listStatesV2` | public | live |
| `POST` | `/login` | `auth.login` | public | spec |
| `POST` | `/login-otp` | `auth.requestLoginOtp` | public | live |
| `POST` | `/login-sso` | `auth.loginSso` | public | spec |
| `POST` | `/logout` | `auth.logout` | Bearer | spec |
| `GET` | `/logs` | `account.listLogs` | Bearer | live |
| `GET` | `/news` | `support.listNews` | Bearer | live |
| `GET` | `/news/{news_id}` | `support.getNews` | Bearer | spec |
| `GET` | `/notifications` | `account.listNotifications` | Bearer | live |
| `GET` | `/notifications/new` | `account.listNewNotifications` | Bearer | live |
| `PUT` | `/notifications/{id}/ack` | `account.acknowledgeNotification` | Bearer | spec |
| `POST` | `/order` | `cart.order` | Bearer | spec |
| `GET` | `/order/{product_id}` | `cart.getProduct` | Bearer | live |
| `POST` | `/order/{product_id}` | `cart.orderProduct` | Bearer | spec |
| `POST` | `/password/change` | `auth.changePassword` | Bearer | spec |
| `POST` | `/password/forgot` | `auth.forgotPassword` | public | spec |
| `POST` | `/password/passreset` | `auth.resetPassword` | public | spec |
| `GET` | `/payment` | `billing.listPaymentMethods` | public | live |
| `GET` | `/payment/fees` | `billing.listPaymentMethodFees` | public | live |
| `POST` | `/quote` | `cart.quote` | Bearer | live |
| `POST` | `/revoke` | `auth.revokeToken` | Bearer | spec |
| `GET` | `/security` | `security.get` | Bearer | live |
| `POST` | `/security/ipaccess` | `security.addIpAccess` | Bearer | spec |
| `DELETE` | `/security/ipaccess/{id}` | `security.removeIpAccess` | Bearer | spec |
| `POST` | `/security/sshkey` | `security.addSshKey` | Bearer | spec |
| `DELETE` | `/security/sshkey/{id}` | `security.removeSshKey` | Bearer | spec |
| `GET` | `/service` | `services.list` | Bearer | live |
| `POST` | `/service/cpanel2/{id}/changedomain` | `cpanel.changePrimaryDomain` | Bearer | spec |
| `GET` | `/service/cpanel2/{id}/changepasss` | `cpanel.changePassword` | Bearer | live |
| `GET` | `/service/cpanel2/{id}/login` | `cpanel.getLoginLink` | Bearer | live |
| `GET` | `/service/cpanel2/{id}/phpmyadminlogin` | `cpanel.getPhpMyAdminLink` | Bearer | live |
| `POST` | `/service/cpanel2/{id}/resetacount` | `cpanel.resetAccount` | Bearer | spec |
| `GET` | `/service/cpanel2/{id}/statistics` | `cpanel.getStatistics` | Bearer | live |
| `POST` | `/service/cpanel2/{id}/unblock` | `cpanel.unblockIp` | Bearer | spec |
| `GET` | `/service/{idtinomail}/logs` | `tinomail.listLogs` | Bearer | spec |
| `GET` | `/service/{idtinomail}/summary` | `tinomail.getSummary` | Bearer | spec |
| `GET` | `/service/{id}` | `services.get` | Bearer | live |
| `POST` | `/service/{id}/cancel` | `services.cancel` | Bearer | spec |
| `GET` | `/service/{id}/cycle` | `services.getBillingCycles` | Bearer | live |
| `POST` | `/service/{id}/cycle` | `services.setBillingCycle` | Bearer | spec |
| `GET` | `/service/{id}/emails` | `services.listEmailAccounts` | Bearer | live |
| `POST` | `/service/{id}/emails` | `services.createEmailAccount` | Bearer | spec |
| `POST` | `/service/{id}/emails/change` | `services.updateEmailAccount` | Bearer | spec |
| `POST` | `/service/{id}/emails/delete` | `services.deleteEmailAccount` | Bearer | spec |
| `GET` | `/service/{id}/invoices` | `services.listInvoices` | Bearer | live |
| `GET` | `/service/{id}/ip` | `services.listIps` | Bearer | live |
| `GET` | `/service/{id}/label` | `services.getLabel` | Bearer | live |
| `POST` | `/service/{id}/label` | `services.setLabel` | Bearer | spec |
| `POST` | `/service/{id}/manualrenew` | `services.manualRenew` | Bearer | spec |
| `GET` | `/service/{id}/methods` | `services.listMethods` | Bearer | live |
| `GET` | `/service/{id}/networks` | `services.listNetworks` | Bearer | live |
| `GET` | `/service/{id}/rdns` | `services.getReverseDns` | Bearer | live |
| `POST` | `/service/{id}/rdns` | `services.updateReverseDns` | Bearer | spec |
| `POST` | `/service/{id}/renew` | `services.renew` | Bearer | spec |
| `GET` | `/service/{id}/resources` | `services.getResources` | Bearer | live |
| `GET` | `/service/{id}/templates` | `services.listOsTemplates` | Bearer | live |
| `GET` | `/service/{id}/upgrade` | `services.getUpgradeOptions` | Bearer | live |
| `POST` | `/service/{id}/upgrade` | `services.requestUpgrade` | Bearer | spec |
| `GET` | `/service/{id}/vms` | `vms.list` | Bearer | live |
| `POST` | `/service/{id}/vms` | `vms.create` | Bearer | spec |
| `DELETE` | `/service/{id}/vms/{vmid}` | `vms.destroy` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}` | `vms.get` | Bearer | live |
| `PUT` | `/service/{id}/vms/{vmid}` | `vms.resize` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/addsshkey` | `vms.setSshKeys` | Bearer | spec |
| `DELETE` | `/service/{id}/vms/{vmid}/backup/{backup_id}/delete` | `vms.deleteBackup` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/backups` | `vms.listBackups` | Bearer | live |
| `POST` | `/service/{id}/vms/{vmid}/backups/create` | `vms.createBackup` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/backups/{backup_id}/restore` | `vms.restoreBackup` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/console` | `vms.openConsole` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/hostname` | `vms.changeHostname` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/interfaces` | `vms.listInterfaces` | Bearer | live |
| `POST` | `/service/{id}/vms/{vmid}/interfaces` | `vms.createInterface` | Bearer | spec |
| `DELETE` | `/service/{id}/vms/{vmid}/interfaces/{iface}` | `vms.removeInterface` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/interfaces/{iface}` | `vms.getInterface` | Bearer | spec |
| `PUT` | `/service/{id}/vms/{vmid}/interfaces/{iface}` | `vms.updateInterface` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/ippool` | `vms.listIpPools` | Bearer | live |
| `POST` | `/service/{id}/vms/{vmid}/ippool/{pool}` | `vms.allocateIps` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/ips` | `vms.listIps` | Bearer | live |
| `POST` | `/service/{id}/vms/{vmid}/reboot` | `vms.reboot` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/rebuild` | `vms.rebuild` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/reset` | `vms.reset` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/resetpwd` | `vms.resetRootPassword` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/shutdown` | `vms.shutdown` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/snapshots` | `vms.listSnapshots` | Bearer | live |
| `POST` | `/service/{id}/vms/{vmid}/snapshots/create` | `vms.createSnapshot` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/snapshots/{snapshot_id}/restore` | `vms.restoreSnapshot` | Bearer | spec |
| `DELETE` | `/service/{id}/vms/{vmid}/snapshots/{snapshot_name}/delete` | `vms.deleteSnapshot` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/snapshotschedule` | `vms.listSnapshotSchedules` | Bearer | live |
| `POST` | `/service/{id}/vms/{vmid}/snapshotschedule/create` | `vms.createSnapshotSchedule` | Bearer | spec |
| `DELETE` | `/service/{id}/vms/{vmid}/snapshotschedule/{schedule_id}/delete` | `vms.deleteSnapshotSchedule` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/start` | `vms.start` | Bearer | spec |
| `POST` | `/service/{id}/vms/{vmid}/stop` | `vms.stop` | Bearer | spec |
| `GET` | `/service/{id}/vms/{vmid}/usage` | `vms.getUsage` | Bearer | live |
| `GET` | `/service/{id}/widgets` | `services.listWidgets` | Bearer | live |
| `GET` | `/service/{service_id}/dns` | `dns.listZones` | Bearer | live |
| `POST` | `/service/{service_id}/dns` | `dns.createZone` | Bearer | spec |
| `DELETE` | `/service/{service_id}/dns/{zone_id}` | `dns.deleteZone` | Bearer | spec |
| `GET` | `/service/{service_id}/dns/{zone_id}` | `dns.getZone` | Bearer | live |
| `GET` | `/service/{service_id}/dns/{zone_id}/dnssec` | `dns.getZoneDnssec` | Bearer | live |
| `PUT` | `/service/{service_id}/dns/{zone_id}/dnssec` | `dns.updateZoneDnssec` | Bearer | spec |
| `GET` | `/service/{service_id}/dns/{zone_id}/password` | `dns.resetZonePassword` | Bearer | spec |
| `POST` | `/service/{service_id}/dns/{zone_id}/records` | `dns.createRecord` | Bearer | spec |
| `DELETE` | `/service/{service_id}/dns/{zone_id}/records/{record_id}` | `dns.deleteRecord` | Bearer | spec |
| `PUT` | `/service/{service_id}/dns/{zone_id}/records/{record_id}` | `dns.updateRecord` | Bearer | spec |
| `GET` | `/services/active` | `services.listActive` | Bearer | live |
| `GET` | `/services/{cid}` | `services.listByCategory` | Bearer | live |
| `POST` | `/signup` | `auth.signup` | public | spec |
| `GET` | `/status` | `account.status` | public | live |
| `POST` | `/submit_contactform` | `account.submitContactForm` | public | spec |
| `GET` | `/ticket/attachment/{file}` | `support.getAttachment` | Bearer | live |
| `GET` | `/ticket/departments` | `support.listDepartments` | Bearer | live |
| `GET` | `/tickets` | `support.listTickets` | Bearer | live |
| `POST` | `/tickets` | `support.createTicket` | Bearer | spec |
| `GET` | `/tickets/{number}` | `support.getTicket` | Bearer | live |
| `POST` | `/tickets/{number}` | `support.replyTicket` | Bearer | spec |
| `PUT` | `/tickets/{number}/close` | `support.closeTicket` | Bearer | spec |
| `PUT` | `/tickets/{number}/open` | `support.reopenTicket` | Bearer | spec |
| `POST` | `/tinosite/{id}/autologin` | `tinosite.autoLogin` | Bearer | spec |
| `POST` | `/tinosite/{id}/backups` | `tinosite.backup` | Bearer | spec |
| `POST` | `/tinosite/{id}/domainpointers` | `tinosite.domainPointerAction` | Bearer | spec |
| `GET` | `/tinosite/{id}/metrics` | `tinosite.getMetrics` | Bearer | spec |
| `GET` | `/tinosite/{id}/plugins` | `tinosite.listPlugins` | Bearer | live |
| `POST` | `/tinosite/{id}/sslcerts` | `tinosite.sslCertificateAction` | Bearer | spec |
| `POST` | `/tinosite/{id}/sslcerts/onoff` | `tinosite.toggleSslCertificate` | Bearer | spec |
| `GET` | `/tinosite/{id}/themes` | `tinosite.listThemes` | Bearer | live |
| `GET` | `/tinosite/{id}/users` | `tinosite.listUsers` | Bearer | spec |
| `POST` | `/tinosite/{id}/users` | `tinosite.createUser` | Bearer | spec |
| `POST` | `/token` | `auth.refreshToken` | public | spec |
| `GET` | `/usage-monitor/account/{id}` | `usageMonitor.getAccountUsage` | Bearer | spec |
| `GET` | `/usage-monitor/nodes/{server_id}` | `usageMonitor.getNodeStatus` | Bearer | spec |
| `POST` | `/usage-monitor/overage` | `usageMonitor.listOverage` | Bearer | spec |
| `GET` | `/usage-monitor/products` | `usageMonitor.listProducts` | Bearer | live |
| `POST` | `/usage-monitor/scan` | `usageMonitor.scan` | Bearer | spec |
| `GET` | `/v2/cart/domain/tlds` | `cart.listDomainTldsV2` | public | live |
| `POST` | `/verification/resend` | `auth.resendVerification` | Bearer | spec |
| `POST` | `/verification/verify` | `auth.verifyAccount` | Bearer | spec |
| `POST` | `/verify-login-otp` | `auth.verifyLoginOtp` | public | live |
| `GET` | `/whois/{domain}` | `domains.whois` | Bearer | live |
