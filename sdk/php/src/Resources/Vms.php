<?php

declare(strict_types=1);

/**
 * Cloud instances / virtual machines.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Cloud instances / virtual machines — 35 operations.
 */
class Vms extends Resource
{
    /**
     * Allocate IPs
     *
     * POST /service/{id}/vms/{vmid}/ippool/{pool} — Bearer token required, from the API specification.
     *
     * Allocate new IP for network interface.
     *
     * Body fields:
     *   - pool (string): List ID to allocate new IP from
     *   - type (string): ipv4 or ipv6
     *   - iface (integer): Interface number
     *   - bridge (string): Bridge name [optional, ignored if interface provided]
     *   - number (integer): Number of IPs to allocate
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param string|int $pool
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function allocateIps($id, $vmid, $pool, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/ippool/{pool}', ['id' => $id, 'vmid' => $vmid, 'pool' => $pool]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Change Hostname VM
     *
     * POST /service/{id}/vms/{vmid}/hostname — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * Body fields:
     *   - server_name (string, required): Virtual server name
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function changeHostname($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/hostname', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Create VM
     *
     * POST /service/{id}/vms — Bearer token required, from the API specification.
     *
     * Add new virtual server
     *
     * Body fields:
     *   - label (string): VM label
     *   - template (string): Template ID
     *   - memory (string): Amount of RAM memory in MB
     *   - cpu (string): Amount of CPU cores
     *   - disk (string): Disk Space in GB
     *   - interface (array): Interface configuration
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function create($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM Create Backup
     *
     * POST /service/{id}/vms/{vmid}/backups/create — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createBackup($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/backups/create', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Add Network Interface
     *
     * POST /service/{id}/vms/{vmid}/interfaces — Bearer token required, verified against the live API.
     *
     * Add new network interface to VM
     *
     * Body fields:
     *   - bridge (string): Network bridge
     *   - firewall (integer): Enable or disable firewall (may require specific permissions)
     *   - ipv4 (array): List of IP v4 IDs
     *   - ipv6 (array): List of IP v6 IDs
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createInterface($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/interfaces', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM Create Snapshot
     *
     * POST /service/{id}/vms/{vmid}/snapshots/create — Bearer token required, verified against the live API.
     *
     * Note: The snapshot name is generated by the platform (A<unix-timestamp>); a name sent in
     * the request is ignored. Read it back from vms.listSnapshots before deleting.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * Body fields:
     *   - description (string, required): description
     *   - vmstate (integer, required): vmstate
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createSnapshot($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/snapshots/create', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM snapshot schedule Create
     *
     * POST /service/{id}/vms/{vmid}/snapshotschedule/create — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * Body fields:
     *   - dow (string, required): Array thứ
     *   - hour (string, required): Giờ
     *   - min (string, required): Phút
     *   - vmstate (integer, required): vmstate
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createSnapshotSchedule($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/snapshotschedule/create', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM Delete Backup
     *
     * DELETE /service/{id}/vms/{vmid}/backup/{backup_id}/delete — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *   - backup_id: Backup VM id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param string|int $backupId Backup VM id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function deleteBackup($id, $vmid, $backupId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/backup/{backup_id}/delete', ['id' => $id, 'vmid' => $vmid, 'backup_id' => $backupId]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM Delete Snapshot
     *
     * DELETE /service/{id}/vms/{vmid}/snapshots/{snapshot_name}/delete — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *   - snapshot_name: Snapshot VM id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param string|int $snapshotName Snapshot VM id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function deleteSnapshot($id, $vmid, $snapshotName, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/snapshots/{snapshot_name}/delete', ['id' => $id, 'vmid' => $vmid, 'snapshot_name' => $snapshotName]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM snapshot schedule delete
     *
     * DELETE /service/{id}/vms/{vmid}/snapshotschedule/{schedule_id}/delete — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param string|int $scheduleId
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function deleteSnapshotSchedule($id, $vmid, $scheduleId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/snapshotschedule/{schedule_id}/delete', ['id' => $id, 'vmid' => $vmid, 'schedule_id' => $scheduleId]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Destroy VM
     *
     * DELETE /service/{id}/vms/{vmid} — Bearer token required, from the API specification.
     *
     * Remove virtual server
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function destroy($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Get VM Details
     *
     * GET /service/{id}/vms/{vmid} — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function get($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get Network Interfaces
     *
     * GET /service/{id}/vms/{vmid}/interfaces/{iface} — Bearer token required, verified against the live API.
     *
     * Get network Interface details
     *
     * Path parameters:
     *   - iface: Interface name or id, ie '0' or 'net0'
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param string|int $iface Interface name or id, ie '0' or 'net0'
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getInterface($id, $vmid, $iface, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/interfaces/{iface}', ['id' => $id, 'vmid' => $vmid, 'iface' => $iface]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get VM usage
     *
     * GET /service/{id}/vms/{vmid}/usage — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getUsage($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/usage', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List VMs
     *
     * GET /service/{id}/vms — Bearer token required, verified against the live API.
     *
     * List virtual servers
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function list($id, array $query = [])
    {
        $path = $this->path('/service/{id}/vms', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * VM List Backup
     *
     * GET /service/{id}/vms/{vmid}/backups — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listBackups($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/backups', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List VM Network Interfaces
     *
     * GET /service/{id}/vms/{vmid}/interfaces — Bearer token required, verified against the live API.
     *
     * Get network interfaces assigned to virtual server
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listInterfaces($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/interfaces', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List IP Pools
     *
     * GET /service/{id}/vms/{vmid}/ippool — Bearer token required, verified against the live API.
     *
     * List IP pools for a specific interface or network bridge
     *
     * Query parameters:
     *   - iface: Interface number [optional]
     *   - bridge: Bridge name [optional, ignored if interface provided]
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listIpPools($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/ippool', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List IPs
     *
     * GET /service/{id}/vms/{vmid}/ips — Bearer token required, verified against the live API.
     *
     * List virtual machine IPs
     *
     * Query parameters:
     *   - type: ipv4 or ipv6
     *   - iface: Interface number [optional]
     *   - bridge: Bridge name [optional, ignored if interface provided]
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listIps($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/ips', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * VM snapshot schedule
     *
     * GET /service/{id}/vms/{vmid}/snapshotschedule — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listSnapshotSchedules($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/snapshotschedule', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * VM List Snapshot
     *
     * GET /service/{id}/vms/{vmid}/snapshots — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listSnapshots($id, $vmid, array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/snapshots', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * console VM
     *
     * POST /service/{id}/vms/{vmid}/console — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function openConsole($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/console', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Reboot VM
     *
     * POST /service/{id}/vms/{vmid}/reboot — Bearer token required, from the API specification.
     *
     * Reboot virtual server
     *
     * Body fields:
     *   - vmid (string): Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function reboot($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/reboot', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Rebuild VM
     *
     * POST /service/{id}/vms/{vmid}/rebuild — Bearer token required, from the API specification.
     *
     * Rebuild server, you can get list of templates supported by this server
     * using '''/service/$id/templates'''
     *
     * Body fields:
     *   - template (string): Template ID
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function rebuild($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/rebuild', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Remove Network Interface
     *
     * DELETE /service/{id}/vms/{vmid}/interfaces/{iface} — Bearer token required, from the API specification.
     *
     * Remove network interface from VM
     *
     * Path parameters:
     *   - iface: Interface name or id to remove
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param string|int $iface Interface name or id to remove
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function removeInterface($id, $vmid, $iface, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/interfaces/{iface}', ['id' => $id, 'vmid' => $vmid, 'iface' => $iface]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Reset VM
     *
     * POST /service/{id}/vms/{vmid}/reset — Bearer token required, verified against the live API.
     *
     * Reset virtual server power
     *
     * Body fields:
     *   - vmid (string): Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function reset($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/reset', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Reset Root Password VM
     *
     * POST /service/{id}/vms/{vmid}/resetpwd — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function resetRootPassword($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/resetpwd', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Resize VM
     *
     * PUT /service/{id}/vms/{vmid} — Bearer token required, from the API specification.
     *
     * Edit a virtual server
     *
     * Body fields:
     *   - vmid (string): Virtual server id
     *   - memory (string): Amount of RAM in MB
     *   - cpu (string): Amount of CPU cores
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function resize($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM Restore Backup
     *
     * POST /service/{id}/vms/{vmid}/backups/{backup_id}/restore — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *   - backup_id: Backup VM id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param string|int $backupId Backup VM id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function restoreBackup($id, $vmid, $backupId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/backups/{backup_id}/restore', ['id' => $id, 'vmid' => $vmid, 'backup_id' => $backupId]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * VM Restore Snapshot
     *
     * POST /service/{id}/vms/{vmid}/snapshots/{snapshot_id}/restore — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *   - snapshot_id: Snapshot VM id
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param string|int $snapshotId Snapshot VM id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function restoreSnapshot($id, $vmid, $snapshotId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/snapshots/{snapshot_id}/restore', ['id' => $id, 'vmid' => $vmid, 'snapshot_id' => $snapshotId]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Change SSHKEY
     *
     * POST /service/{id}/vms/{vmid}/addsshkey — Bearer token required, from the API specification.
     *
     * Get the details of a particular virtual server
     *
     * Path parameters:
     *   - vmid: Virtual server id
     *
     * Body fields:
     *   - keys (array, required): SSK Key ID
     *
     * @param string|int $id
     * @param string|int $vmid Virtual server id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function setSshKeys($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/addsshkey', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Shutdown VM
     *
     * POST /service/{id}/vms/{vmid}/shutdown — Bearer token required, verified against the live API.
     *
     * Perform graceful shutdown
     *
     * Body fields:
     *   - vmid (string): Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function shutdown($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/shutdown', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Start VM
     *
     * POST /service/{id}/vms/{vmid}/start — Bearer token required, verified against the live API.
     *
     * Start virtual server
     *
     * Body fields:
     *   - vmid (string): Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function start($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/start', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Stop VM
     *
     * POST /service/{id}/vms/{vmid}/stop — Bearer token required, verified against the live API.
     *
     * Stop virtual server
     *
     * Body fields:
     *   - vmid (string): Virtual server id
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function stop($id, $vmid, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/stop', ['id' => $id, 'vmid' => $vmid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update Network Interface
     *
     * PUT /service/{id}/vms/{vmid}/interfaces/{iface} — Bearer token required, from the API specification.
     *
     * Update network interface details
     *
     * Body fields:
     *   - iface (integer): Interface number
     *   - firewall (integer): Enable or disable firewall (may require specific permissions)
     *   - ipv4 (array): List of IP v4 IDs
     *   - ipv6 (array): List of IP v6 IDs
     *
     * @param string|int $id
     * @param string|int $vmid
     * @param string|int $iface
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateInterface($id, $vmid, $iface, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/vms/{vmid}/interfaces/{iface}', ['id' => $id, 'vmid' => $vmid, 'iface' => $iface]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

}
