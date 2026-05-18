from docx2pdf import convert
import os

BASE = os.path.dirname(__file__)
INPUT = os.path.join(BASE, '..', 'BAO_CAO_NCKH_SNIKEI_SHOP_THEO_YEU_CAU_EXPANDED_WITH_IMAGES.docx')
OUTPUT = INPUT.replace('.docx', '.pdf')

if not os.path.exists(INPUT):
    print('Input not found:', INPUT)
    raise SystemExit(1)

print('Chuyển sang PDF:', INPUT, '->', OUTPUT)
convert(INPUT, OUTPUT)
print('Hoàn tất PDF:', OUTPUT)
