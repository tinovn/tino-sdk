"""Cloud instances / virtual machines.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class VmsResource(Resource):
    """Cloud instances / virtual machines — 35 operations."""

    def allocate_ips(self, id, vmid, pool, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Allocate IPs

        POST /service/{id}/vms/{vmid}/ippool/{pool} — Bearer token required, from the API specification.

        Allocate new IP for network interface.

        Body fields:
          - pool (string): List ID to allocate new IP from
          - type (string): ipv4 or ipv6
          - iface (integer): Interface number
          - bridge (string): Bridge name [optional, ignored if interface provided]
          - number (integer): Number of IPs to allocate
        """
        path = self._path("/service/{id}/vms/{vmid}/ippool/{pool}", id=id, vmid=vmid, pool=pool)
        return self._call("POST", path, body=self._body(body, fields))

    def change_hostname(self, id, vmid, server_name, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Change Hostname VM

        POST /service/{id}/vms/{vmid}/hostname — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
          - server_name: Virtual server name
        """
        path = self._path("/service/{id}/vms/{vmid}/hostname", id=id, vmid=vmid, server_name=server_name)
        return self._call("POST", path, body=self._body(body, fields))

    def create(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Create VM

        POST /service/{id}/vms — Bearer token required, from the API specification.

        Add new virtual server

        Body fields:
          - label (string): VM label
          - template (string): Template ID
          - memory (string): Amount of RAM memory in MB
          - cpu (string): Amount of CPU cores
          - disk (string): Disk Space in GB
          - interface (array): Interface configuration
        """
        path = self._path("/service/{id}/vms", id=id)
        return self._call("POST", path, body=self._body(body, fields))

    def create_backup(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM Create Backup

        POST /service/{id}/vms/{vmid}/backups/create — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/backups/create", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def create_interface(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Add Network Interface

        POST /service/{id}/vms/{vmid}/interfaces — Bearer token required, from the API specification.

        Add new network interface to VM

        Body fields:
          - bridge (string): Network bridge
          - firewall (integer): Enable or disable firewall (may require specific permissions)
          - ipv4 (array): List of IP v4 IDs
          - ipv6 (array): List of IP v6 IDs
        """
        path = self._path("/service/{id}/vms/{vmid}/interfaces", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def create_snapshot(self, id, vmid, description, vmstate, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM Create Snapshot

        POST /service/{id}/vms/{vmid}/snapshots/create — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
          - description: description
          - vmstate: vmstate
        """
        path = self._path("/service/{id}/vms/{vmid}/snapshots/create", id=id, vmid=vmid, description=description, vmstate=vmstate)
        return self._call("POST", path, body=self._body(body, fields))

    def create_snapshot_schedule(self, id, vmid, dow, hour, min, vmstate, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM snapshot schedule Create

        POST /service/{id}/vms/{vmid}/snapshotschedule/create — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
          - dow: Array thứ
          - hour: Giờ
          - min: Phút
          - vmstate: vmstate
        """
        path = self._path("/service/{id}/vms/{vmid}/snapshotschedule/create", id=id, vmid=vmid, dow=dow, hour=hour, min=min, vmstate=vmstate)
        return self._call("POST", path, body=self._body(body, fields))

    def delete_backup(self, id, vmid, backup_id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM Delete Backup

        DELETE /service/{id}/vms/{vmid}/backup/{backup_id}/delete — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
          - backup_id: Backup VM id
        """
        path = self._path("/service/{id}/vms/{vmid}/backup/{backup_id}/delete", id=id, vmid=vmid, backup_id=backup_id)
        return self._call("DELETE", path, body=self._body(body, fields))

    def delete_snapshot(self, id, vmid, snapshot_name, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM Delete Snapshot

        DELETE /service/{id}/vms/{vmid}/snapshots/{snapshot_name}/delete — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
          - snapshot_name: Snapshot VM id
        """
        path = self._path("/service/{id}/vms/{vmid}/snapshots/{snapshot_name}/delete", id=id, vmid=vmid, snapshot_name=snapshot_name)
        return self._call("DELETE", path, body=self._body(body, fields))

    def delete_snapshot_schedule(self, id, vmid, schedule_id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM snapshot schedule delete

        DELETE /service/{id}/vms/{vmid}/snapshotschedule/{schedule_id}/delete — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/snapshotschedule/{schedule_id}/delete", id=id, vmid=vmid, schedule_id=schedule_id)
        return self._call("DELETE", path, body=self._body(body, fields))

    def destroy(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Destroy VM

        DELETE /service/{id}/vms/{vmid} — Bearer token required, from the API specification.

        Remove virtual server

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}", id=id, vmid=vmid)
        return self._call("DELETE", path, body=self._body(body, fields))

    def get(self, id, vmid, **query: Any) -> Any:
        """Get VM Details

        GET /service/{id}/vms/{vmid} — Bearer token required, verified against the live API.

        Get the details of a particular virtual server

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}", id=id, vmid=vmid)
        return self._call("GET", path, query=query)

    def get_interface(self, id, vmid, iface, **query: Any) -> Any:
        """Get Network Interfaces

        GET /service/{id}/vms/{vmid}/interfaces/{iface} — Bearer token required, from the API specification.

        Get network Interface details

        Path parameters:
          - iface: Interface name or id, ie '0' or 'net0'
        """
        path = self._path("/service/{id}/vms/{vmid}/interfaces/{iface}", id=id, vmid=vmid, iface=iface)
        return self._call("GET", path, query=query)

    def get_usage(self, id, vmid, **query: Any) -> Any:
        """Get VM usage

        GET /service/{id}/vms/{vmid}/usage — Bearer token required, verified against the live API.

        Get the details of a particular virtual server

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/usage", id=id, vmid=vmid)
        return self._call("GET", path, query=query)

    def list(self, id, **query: Any) -> Any:
        """List VMs

        GET /service/{id}/vms — Bearer token required, verified against the live API.

        List virtual servers
        """
        path = self._path("/service/{id}/vms", id=id)
        return self._call("GET", path, query=query)

    def list_backups(self, id, vmid, **query: Any) -> Any:
        """VM List Backup

        GET /service/{id}/vms/{vmid}/backups — Bearer token required, verified against the live API.

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/backups", id=id, vmid=vmid)
        return self._call("GET", path, query=query)

    def list_interfaces(self, id, vmid, **query: Any) -> Any:
        """List VM Network Interfaces

        GET /service/{id}/vms/{vmid}/interfaces — Bearer token required, verified against the live API.

        Get network interfaces assigned to virtual server
        """
        path = self._path("/service/{id}/vms/{vmid}/interfaces", id=id, vmid=vmid)
        return self._call("GET", path, query=query)

    def list_ip_pools(self, id, vmid, *, iface: Any = None, bridge: Any = None, **query: Any) -> Any:
        """List IP Pools

        GET /service/{id}/vms/{vmid}/ippool — Bearer token required, verified against the live API.

        List IP pools for a specific interface or network bridge

        Query parameters:
          - iface: Interface number [optional]
          - bridge: Bridge name [optional, ignored if interface provided]
        """
        path = self._path("/service/{id}/vms/{vmid}/ippool", id=id, vmid=vmid)
        params = self._query({"iface": iface, "bridge": bridge}, query)
        return self._call("GET", path, query=params)

    def list_ips(self, id, vmid, *, type: Any = None, iface: Any = None, bridge: Any = None, **query: Any) -> Any:
        """List IPs

        GET /service/{id}/vms/{vmid}/ips — Bearer token required, verified against the live API.

        List virtual machine IPs

        Query parameters:
          - type: ipv4 or ipv6
          - iface: Interface number [optional]
          - bridge: Bridge name [optional, ignored if interface provided]
        """
        path = self._path("/service/{id}/vms/{vmid}/ips", id=id, vmid=vmid)
        params = self._query({"type": type, "iface": iface, "bridge": bridge}, query)
        return self._call("GET", path, query=params)

    def list_snapshot_schedules(self, id, vmid, **query: Any) -> Any:
        """VM snapshot schedule

        GET /service/{id}/vms/{vmid}/snapshotschedule — Bearer token required, verified against the live API.

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/snapshotschedule", id=id, vmid=vmid)
        return self._call("GET", path, query=query)

    def list_snapshots(self, id, vmid, **query: Any) -> Any:
        """VM List Snapshot

        GET /service/{id}/vms/{vmid}/snapshots — Bearer token required, verified against the live API.

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/snapshots", id=id, vmid=vmid)
        return self._call("GET", path, query=query)

    def open_console(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """console VM

        POST /service/{id}/vms/{vmid}/console — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/console", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def reboot(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Reboot VM

        POST /service/{id}/vms/{vmid}/reboot — Bearer token required, from the API specification.

        Reboot virtual server

        Body fields:
          - vmid (string): Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/reboot", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def rebuild(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Rebuild VM

        POST /service/{id}/vms/{vmid}/rebuild — Bearer token required, from the API specification.

        Rebuild server, you can get list of templates supported by this server
        using '''/service/$id/templates'''

        Body fields:
          - template (string): Template ID
        """
        path = self._path("/service/{id}/vms/{vmid}/rebuild", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def remove_interface(self, id, vmid, iface, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Remove Network Interface

        DELETE /service/{id}/vms/{vmid}/interfaces/{iface} — Bearer token required, from the API specification.

        Remove network interface from VM

        Path parameters:
          - iface: Interface name or id to remove
        """
        path = self._path("/service/{id}/vms/{vmid}/interfaces/{iface}", id=id, vmid=vmid, iface=iface)
        return self._call("DELETE", path, body=self._body(body, fields))

    def reset(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Reset VM

        POST /service/{id}/vms/{vmid}/reset — Bearer token required, from the API specification.

        Reset virtual server power

        Body fields:
          - vmid (string): Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/reset", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def reset_root_password(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Reset Root Password VM

        POST /service/{id}/vms/{vmid}/resetpwd — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/resetpwd", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def resize(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Resize VM

        PUT /service/{id}/vms/{vmid} — Bearer token required, from the API specification.

        Edit a virtual server

        Body fields:
          - vmid (string): Virtual server id
          - memory (string): Amount of RAM in MB
          - cpu (string): Amount of CPU cores
        """
        path = self._path("/service/{id}/vms/{vmid}", id=id, vmid=vmid)
        return self._call("PUT", path, body=self._body(body, fields))

    def restore_backup(self, id, vmid, backup_id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM Restore Backup

        POST /service/{id}/vms/{vmid}/backups/{backup_id}/restore — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
          - backup_id: Backup VM id
        """
        path = self._path("/service/{id}/vms/{vmid}/backups/{backup_id}/restore", id=id, vmid=vmid, backup_id=backup_id)
        return self._call("POST", path, body=self._body(body, fields))

    def restore_snapshot(self, id, vmid, snapshot_id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """VM Restore Snapshot

        POST /service/{id}/vms/{vmid}/snapshots/{snapshot_id}/restore — Bearer token required, from the API specification.

        Path parameters:
          - vmid: Virtual server id
          - snapshot_id: Snapshot VM id
        """
        path = self._path("/service/{id}/vms/{vmid}/snapshots/{snapshot_id}/restore", id=id, vmid=vmid, snapshot_id=snapshot_id)
        return self._call("POST", path, body=self._body(body, fields))

    def set_ssh_keys(self, id, vmid, keys, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Change SSHKEY

        POST /service/{id}/vms/{vmid}/addsshkey — Bearer token required, from the API specification.

        Get the details of a particular virtual server

        Path parameters:
          - vmid: Virtual server id
          - keys: SSK Key ID
        """
        path = self._path("/service/{id}/vms/{vmid}/addsshkey", id=id, vmid=vmid, keys=keys)
        return self._call("POST", path, body=self._body(body, fields))

    def shutdown(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Shutdown VM

        POST /service/{id}/vms/{vmid}/shutdown — Bearer token required, from the API specification.

        Perform graceful shutdown

        Body fields:
          - vmid (string): Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/shutdown", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def start(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Start VM

        POST /service/{id}/vms/{vmid}/start — Bearer token required, from the API specification.

        Start virtual server

        Body fields:
          - vmid (string): Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/start", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def stop(self, id, vmid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Stop VM

        POST /service/{id}/vms/{vmid}/stop — Bearer token required, from the API specification.

        Stop virtual server

        Body fields:
          - vmid (string): Virtual server id
        """
        path = self._path("/service/{id}/vms/{vmid}/stop", id=id, vmid=vmid)
        return self._call("POST", path, body=self._body(body, fields))

    def update_interface(self, id, vmid, iface, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Update Network Interface

        PUT /service/{id}/vms/{vmid}/interfaces/{iface} — Bearer token required, from the API specification.

        Update network interface details

        Body fields:
          - iface (integer): Interface number
          - firewall (integer): Enable or disable firewall (may require specific permissions)
          - ipv4 (array): List of IP v4 IDs
          - ipv6 (array): List of IP v6 IDs
        """
        path = self._path("/service/{id}/vms/{vmid}/interfaces/{iface}", id=id, vmid=vmid, iface=iface)
        return self._call("PUT", path, body=self._body(body, fields))
