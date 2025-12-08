import os
from PyPDF2 import PdfReader

folder = r"D:\2ND TERM 2025-2026 BILL-\special" #REPLACE WITH YOUR FILE PATH HERE

for filename in os.listdir(folder):
    if filename.lower().endswith(".pdf"):
        pdf_path = os.path.join(folder, filename)

        try:
            reader = PdfReader(pdf_path)
            first_page = reader.pages[0]
            text = first_page.extract_text()

            if not text:
                print(f"Cannot extract text from {filename}")
                continue

            # Split lines and get line 5
            lines = text.split("\n")
            if len(lines) < 5:
                print(f"{filename} does not have 5 lines")
                continue

            new_name_line = lines[4].strip()
            # Clean filename
            safe_name = "".join(c for c in new_name_line if c.isalnum() or c in " _-").strip()

            if not safe_name:
                print(f"Invalid line 5 name in {filename}")
                continue

            new_filename = safe_name + ".pdf"
            new_path = os.path.join(folder, new_filename)

            os.rename(pdf_path, new_path)
            print(f"Renamed: {filename} -> {new_filename}")

        except Exception as e:
            print(f"Error processing {filename}: {e}")
