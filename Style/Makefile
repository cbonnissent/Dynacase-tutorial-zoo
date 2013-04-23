# ============================================
# $Id: Makefile,v 1.1 2006/11/08 17:52:16 eric Exp $
# ============================================

# get the new appname (basename in uppercase)
dirname = ZOO
appname = STYLE/$(dirname)
export appname


SUBDIR= Images
include $(utildir)/PubRule


DISTFILES +=  $(dirname).sty

$(pubdir)/$(appname)/$(dirname).sty : $(dirname).sty
	cp $< $@

publish: $(pubdir)/$(appname)/$(dirname).sty
